<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
  protected $table = 'Wartungsvertraege';
  protected $primaryKey = 'ID';

  public $timestamps = true;
}
