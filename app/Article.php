<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $table = 'Artikel';
  protected $primaryKey = 'ID';

  protected $fillable = [
    'Artikel_Wartungsvertraege_ID',
    'Artikel_Produkte_ID',
    'Seriennummer',
    'EKP_Artikel',
    'EKP_Artikel_Waehrungen_ID',
    'VKP_Artikel',
    'VKP_Artikel_Waehrungen_ID',
    'Auftragsnummer',
    'Auftragsdatum',
    'Rechnungsnummer',
    'Rechnungsdatum',
    'Artikel_Maintenance_ID',
    'Maintenance_Start',
    'Maintenance_von',
    'Maintenance_bis',
    'EKP_Maintenance',
    'EKP_Maintenance_Waehrungen_ID',
    'VKP_Maintenance',
    'VKP_Maintenance_Waehrungen_ID',
    'Artikel_Operationsupport_ID',
    'Operationsupport_Start',
    'Operationsupport_von',
    'Operationsupport_bis',
    'VKP_Operationsupport',
    'VKP_Operationsupport_Waehrungen_ID'
  ];

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
