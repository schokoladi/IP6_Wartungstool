<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die OperationsupportStundenpool-Klasse beschreibt das OS-Stundenpool-Modell,
 * über welches auf die Datenbank zugegriffen werden kann.
 */
class OperationsupportStundenpool extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Operationsupport_Stundenpools';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

}
