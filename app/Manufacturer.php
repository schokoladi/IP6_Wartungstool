<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Manufacturer-Klasse beschreibt das Hersteller-Modell, über welches auf die
 * Datenbank zugegriffen werden kann.
 */
class Manufacturer extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Hersteller';
  protected $primaryKey = 'ID';

  // Füllbare Tabellenfelder. notwendig für firstOrNew()
  protected $fillable = ['Name'];

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

}
