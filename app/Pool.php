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

  public function ospool()
  {
    return $this->hasOne('App\OperationsupportStundenpool', 'ID', 'Stundenpools_OS_Stundenpools_ID');
  }
}
