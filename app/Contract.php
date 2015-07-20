<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
  protected $table = 'Wartungsvertraege';
  protected $primaryKey = 'ID';

  public $timestamps = true;

  public function customer()
  {
    return $this->hasOne('App\Customer', 'ID', 'Wartungsvertraege_Kunden_ID');
  }

  public function contact()
  {
    return $this->hasOne('App\Contact', 'ID', 'Wartungsvertraege_Kontaktpersonen_ID');
  }

  // Funktion zum Holen der zum Wartungsvertrag gehörigen Artikel
  public function articles()
  {
    return $this->hasMany('App\Article', 'Artikel_Wartungsvertraege_ID', 'ID');
  }

  public function pools()
  {
    return $this->hasMany('App\Pool', 'Stundenpools_Wartungsvertraege_ID', 'ID');
  }

}
