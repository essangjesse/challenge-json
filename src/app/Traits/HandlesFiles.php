<?php

namespace App\Traits;

use Illuminate\Validation\Validator;

trait HandlesFiles
{
  public function decodeJson($file){
    return json_decode(file_get_contents($file), true);
  }
}
