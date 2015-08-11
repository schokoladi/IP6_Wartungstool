<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Currency-Klasse beschreibt das Waehrung-Modell, über welches auf die Datenbank
 * zugegriffen werden kann.
 */
class Currency extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Waehrungen';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;
  
}
