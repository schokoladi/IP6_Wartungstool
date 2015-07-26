<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
  protected $table = 'Waehrungen';
  protected $primaryKey = 'ID';

  public $timestamps = true;
}
