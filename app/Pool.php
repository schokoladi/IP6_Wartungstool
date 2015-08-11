<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Pool-Klasse beschreibt das Stundenpool-Modell, über welches auf die Datenbank
 * zugegriffen werden kann.
 */
class Pool extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Stundenpools';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

  /**
  * Holt das zum Pool gehörigen OS-Pool aus dessen Model / Tabelle
  */
  public function ospool()
  {
    return $this->hasOne('App\OperationsupportStundenpool', 'ID', 'Stundenpools_OS_Stundenpools_ID');
  }
  
}
