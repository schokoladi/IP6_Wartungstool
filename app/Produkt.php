<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    // Tabellenname und Primärschlüssel
    protected $table = 'Produkte';
    protected $primaryKey = 'ID';

    public $timestamps = true;

}
