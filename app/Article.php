<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $table = 'Artikel';
  protected $primaryKey = 'ID';

  public $timestamps = true;


  public function product()
  {
    return $this->hasOne('App\Product', 'ID', 'Artikel_Produkte_ID');
  }
  /*
  public function currency()
  {
    return $this->hasOne('App\Curreny', 'ID', 'Wartungsvertraege_Kunden_ID');
  }
  */

  public function maintenance()
  {
    return $this->hasOne('App\Maintenance', 'ID', 'Artikel_Maintenance_ID');
  }

  /*
  public function operationsupport()
  {
    return $this->hasOne('App\Operationsupport', 'ID', 'Artikel_OperationSupports_ID');
  }
  */

}
