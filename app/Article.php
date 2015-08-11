<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Article-Klasse beschreibt das Artikel-Modell, über welches auf die Datenbank
 * zugegriffen werden kann.
 */
class Article extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Artikel';
  protected $primaryKey = 'ID';

  // Füllbare Tabellenfelder
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

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

  /**
  * Holt das zum Artikel gehörige Produkt aus dessen Model / Tabelle
  */
  public function product()
  {
    return $this->hasOne('App\Product', 'ID', 'Artikel_Produkte_ID');
  }

  /**
  * Holt die zum Artikel gehörige Wartung aus deren Model / Tabelle
  */
  public function maintenance()
  {
    return $this->hasOne('App\Maintenance', 'ID', 'Artikel_Maintenance_ID');
  }

}
