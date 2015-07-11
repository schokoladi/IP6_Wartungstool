<?php

use Illuminate\Database\Seeder;

class KontaktpersonenTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('Kontaktpersonen')->delete();
    DB::table('Kontaktpersonen')->insert([
      [
        'Vorname' => 'Suzanne',
        'Name' => 'Thoma',
        'Kontaktpersonen_Kunden_ID' => '1',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Urs',
        'Name' => 'Gasche',
        'Kontaktpersonen_Kunden_ID' => '1',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Urs',
        'Name' => 'Schaeppi',
        'Kontaktpersonen_Kunden_ID' => '2',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Hansueli',
        'Name' => 'Loosli',
        'Kontaktpersonen_Kunden_ID' => '2',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Peter',
        'Name' => 'Hasler',
        'Kontaktpersonen_Kunden_ID' => '3',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Urs',
        'Name' => 'Riedener',
        'Kontaktpersonen_Kunden_ID' => '4',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'Vorname' => 'Konrad',
        'Name' => 'Graber',
        'Kontaktpersonen_Kunden_ID' => '4',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ]
    ]);
  }
}
