<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Contract-Klasse beschreibt das Wartungsvertrags-Modell, über welches auf
 * die Datenbank zugegriffen werden kann.
 */
class Contract extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Wartungsvertraege';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

  /**
  * Holt den zum Wartungsvertrag gehörigen Kunden aus dessen Model / Tabelle
  */
  public function customer()
  {
    return $this->hasOne('App\Customer', 'ID', 'Wartungsvertraege_Kunden_ID');
  }

  /**
  * Holt die zum Wartungsvertrag gehörige Kontaktperson aus deren Model / Tabelle
  */
  public function contact()
  {
    return $this->hasOne('App\Contact', 'ID', 'Wartungsvertraege_Kontaktpersonen_ID');
  }

  /**
  * Holt die zum Wartungsvertrag gehörigen Artikel aus deren Model / Tabelle
  */
  public function articles()
  {
    return $this->hasMany('App\Article', 'Artikel_Wartungsvertraege_ID', 'ID');
  }

  /**
  * Holt die zum Wartungsvertrag gehörigen Stundenpools aus deren Model / Tabelle
  */
  public function pools()
  {
    return $this->hasMany('App\Pool', 'Stundenpools_Wartungsvertraege_ID', 'ID');
  }

}
