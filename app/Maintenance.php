<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Maintenance-Klasse beschreibt das Wartung-Modell, über welches auf die
 * Datenbank zugegriffen werden kann.
 */
class Maintenance extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Maintenance';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;
  
}
