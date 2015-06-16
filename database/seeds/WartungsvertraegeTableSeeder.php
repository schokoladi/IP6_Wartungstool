<?php

use Illuminate\Database\Seeder;

class WartungsvertraegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('Wartungsvertraege')->delete();
      DB::table('Wartungsvertraege')->insert([
          [
            'Vertragsnummer' => 'A14TL919-150-500120',
            'Beschreibung' => 'Test hallo Velo',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Vertragsnummer' => 'A14TL919-150-500122',
            'Beschreibung' => 'Zweiter Vertrag',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
