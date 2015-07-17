<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
  protected $table = 'Maintenances';
  protected $primaryKey = 'ID';

  //protected $fillable = ['Artikelnummer', 'Name', 'Produkte_Hersteller_ID'];

  public $timestamps = true;
}
