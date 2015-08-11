<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Customer-Klasse beschreibt das Kunde-Modell, über welches auf die Datenbank
 * zugegriffen werden kann.
 */
class Customer extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Kunden';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

  /**
  * Holt die zum Kunden gehörigen Kontaktpersonen aus dessen Model / Tabelle
  */
  public function contact()
  {
    return $this->hasMany('App\Contact', 'Kontaktpersonen_Kunden_ID', 'ID');
  }
  
}
