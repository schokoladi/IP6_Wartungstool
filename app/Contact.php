<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Die Contact-Klasse beschreibt das Kontakpersonen-Modell, über welches auf die
 * Datenbank zugegriffen werden kann.
 */
class Contact extends Model
{

  // Tabellenname und Primärschlüssel
  protected $table = 'Kontaktpersonen';
  protected $primaryKey = 'ID';

  // Timestamps ('created_at' und 'updated_at')
  public $timestamps = true;

}
