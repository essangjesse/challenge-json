<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\People;
use Illuminate\Validation\Validator;

trait HandlesImports
{
  /**
   * Import contents into DB if passes criteria
   *
   * @return void
   */
  public function import($contents = []){
    foreach($contents as $content){
      if($this->passesCriteria($content)){
        People::create([
          'name' => $content['name'],
          'email' => $content['email'],
          'address' => $content['address'],
          'checked' => $content['checked'],
          'description' => $content['description'],
          'interest' => $content['interest'],
          'account' => $content['account'],
          'credit_card' => json_encode($content['credit_card']),
          'date_of_birth' => $content['date_of_birth']
        ]);
      }
    }
  }

  /**
   * Check content passes pre-defined criteria.
   *
   * @return boolean
   */
  public function passesCriteria($content){
    if($this->passesAgeCriterion($content['date_of_birth']))
      return true;
    return false;
  }

  /**
   * Define condition for passing age criterion.
   *
   * @return boolean
   */
  public function passesAgeCriterion($dateOfBirth){
    if(isset($dateOfBirth)){
      try {
        $age = Carbon::parse($dateOfBirth)->age;
      } catch (\Exception $e) {
        try {
          $age = Carbon::createFromFormat('d/m/Y', $dateOfBirth)->age;
        } catch (\Exception $e) {
          $age = null;
        }
      }
    }else{
      $age = null;
    }

    if(isset($age)){
      $isRightAge = $age >= 18 && $age <= 65 ? true : false;
    }else{
      $isRightAge = true;
    }

    return $isRightAge;
  }
}
