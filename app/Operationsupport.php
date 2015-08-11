<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Operationsupport-Klasse beschreibt das Operation-Support-Modell, über welches
 * auf die Datenbank zugegriffen werden kann.
 */
class Operationsupport extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Operationsupport';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

}
