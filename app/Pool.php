<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
  protected $table = 'Stundenpools';
  protected $primaryKey = 'ID';

  // notwendig für firstOrNew !!!!
  //protected $fillable = ['Name'];

  public $timestamps = true;
}
