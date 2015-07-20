<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */
  // Tabellenname und Primärschlüssel
  protected $table = 'Produkte';
  protected $primaryKey = 'ID';

  protected $fillable = ['Artikelnummer', 'Name', 'Produkte_Hersteller_ID'];

  public $timestamps = true;


  /**
  * Holt den zum Produkt gehörigen Hersteller
  */
  public function manufacturer()
  {
    return $this->belongsTo('App\Manufacturer', 'Produkte_Hersteller_ID', 'ID');
  }

}
