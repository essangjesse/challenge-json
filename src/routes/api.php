<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\v1\UploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/health', function(){
  return response()->json([
    'status' => true
  ], 200);
});

Route::group([
  'prefix' => 'v1'
], function(){
  Route::post('/json/upload', [UploadController::class, 'upload']);
});
