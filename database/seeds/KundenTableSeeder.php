<?php

use Illuminate\Database\Seeder;

/**
* Die KundenTableSeeder-Klasse füllt die Kunden-Tabelle mit den angegebenen Werten
*/
class KundenTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('Kunden')->delete();
    DB::table('Kunden')->insert([
      [
        'Name' => 'Nestlé',
        'Adresse' => 'Avenue Nestlé 55',
        'PLZ' => '1800',
        'Ort' => 'Vevey',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Name' => 'Swisscom Schweiz AG',
        'Adresse' => 'Alte Tiefenaustrasse 6',
        'PLZ' => '3048',
        'Ort' => 'Worblaufen',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Name' => 'Die Schweizerische Post',
        'Adresse' => 'Eigerstrasse 55',
        'PLZ' => '3007',
        'Ort' => 'Bern',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Name' => 'Emmi Frischeprodukte AG',
        'Adresse' => 'Milchstrasse 9',
        'PLZ' => '3072',
        'Ort' => 'Ostermundigen',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
        ]
      ]);
  }

}
