<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'Kunden';
  protected $primaryKey = 'ID';

  public $timestamps = true;

  /**
  * Holt die zum Kunden gehörigen Kontaktpersonen
  */
  public function contact()
  {
    return $this->hasMany('App\Contact', 'Kontaktpersonen_Kunden_ID', 'ID');
  }
}
