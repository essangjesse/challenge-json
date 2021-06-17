<?php

namespace App\Http\Controllers\Apis\v1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\People;
use App\Traits\HandlesFiles;
use App\Traits\HandlesJsonResponse;
use App\Jobs\ProcessFileContents;

class UploadController extends Controller
{
  use HandlesJsonResponse, HandlesFiles;

  public function upload(Request $request){
    $rules = [
      'file' => 'required|file|max:10240'
    ];

    $validator =  Validator::make($request->all(), $rules);

    if($validator->fails()){
      return $this->jsonValidationError($validator);
    }

    $fileMimeType = $request->file->getClientMimeType();

    switch ($fileMimeType) {
      case 'application/json':
        $contents = $this->decodeJson($request->file);
        break;

      default:
        return $this->jsonResponse('File type not supported.', __('response.codes.error'), 400, [], __('response.errors.request'));
        break;
    }

    if(is_array($contents)){
      $chunkedContents = array_chunk($contents, 100);

      foreach ($chunkedContents as $content) {
        dispatch(new ProcessFileContents($content));
      }

      $response = $this->jsonResponse('File contents successfully queued for importing.');
    }else{
      $response = $this->jsonResponse('File content is invalid.', __('response.codes.error'), 400, [], __('response.errors.request'));
    }

    return $response;
  }
}
