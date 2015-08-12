<?php

use Illuminate\Database\Seeder;

/**
* Die WartungsvertraegeTableSeeder-Klasse füllt die Wartungsvertraege-Tabelle
* mit den angegebenen Werten
*/
class WartungsvertraegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Wartungsvertraege')->delete();
      DB::table('Wartungsvertraege')->insert([
          [
            'Vertragsnummer' => 'A14TL919-150-500120',
            'Beschreibung' => 'Test hallo Velo BKW',
            'Inaktiv' => false,
            'Zustaendigkeit' => 'TL',
            'Wartungsvertraege_Kunden_ID' => '1',
            'Wartungsvertraege_Kontaktpersonen_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Vertragsnummer' => 'A14TL919-150-77550',
            'Beschreibung' => 'Zweiter Vertrag BKW',
            'Inaktiv' => false,
            'Zustaendigkeit' => 'TL',
            'Wartungsvertraege_Kunden_ID' => '1',
            'Wartungsvertraege_Kontaktpersonen_ID' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Vertragsnummer' => 'A14TL919-150-500122',
            'Beschreibung' => 'Test-Vertrag Swisscom',
            'Inaktiv' => false,
            'Zustaendigkeit' => 'TL',
            'Wartungsvertraege_Kunden_ID' => '2',
            'Wartungsvertraege_Kontaktpersonen_ID' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Vertragsnummer' => 'A14TL919-150-24324',
            'Beschreibung' => 'Post-Vertrag',
            'Inaktiv' => false,
            'Zustaendigkeit' => 'TL',
            'Wartungsvertraege_Kunden_ID' => '3',
            'Wartungsvertraege_Kontaktpersonen_ID' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Vertragsnummer' => 'A14TL919-150-43222',
            'Beschreibung' => 'Vertrag mit Emmi',
            'Inaktiv' => false,
            'Zustaendigkeit' => 'TL',
            'Wartungsvertraege_Kunden_ID' => '4',
            'Wartungsvertraege_Kontaktpersonen_ID' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
