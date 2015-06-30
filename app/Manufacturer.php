<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
  protected $table = 'Hersteller';
  protected $primaryKey = 'ID';

  public $timestamps = true;

  /*
  public function products()
  {
    return $this->hasMany('App\Product', 'Produkte_Hersteller_ID', 'ID');
  }
  */
  
}
