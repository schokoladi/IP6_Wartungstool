<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Product-Klasse beschreibt das Produkt-Modell, über welches auf die Datenbank
 * zugegriffen werden kann.
 */
class Product extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Produkte';
  protected $primaryKey = 'ID';

  // Füllbare Tabellenfelder
  protected $fillable = ['Artikelnummer', 'Name', 'Produkte_Hersteller_ID'];

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

  /**
  * Holt den Hersteller aus dessen Model / Tabelle, zu welchem das Produkt gehört
  */
  public function manufacturer()
  {
    return $this->belongsTo('App\Manufacturer', 'Produkte_Hersteller_ID', 'ID');
  }

}
