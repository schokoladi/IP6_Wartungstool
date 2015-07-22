<?php

use Illuminate\Database\Seeder;

class StundenpoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Stundenpools')->delete();
      DB::table('Stundenpools')->insert([
          [
            'Stundenpool_Start' => '2013-01-01',
            'Stundenpool_von' => '2013-01-10',
            'Stundenpool_bis' => '2013-12-23',
            'Stundensatz' => '140.00',
            'Stundenpools_Waehrungen_ID' => '1',
            'Anzahl_Stunden' => '40',
            'Rechnungsnummer' => 'RE-SP234234234',
            'Rechnungsdatum' => '2013-05-04',
            'Stundenpools_Wartungsvertraege_ID' => '1',
            'Stundenpools_OS_Stundenpools_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Stundenpool_Start' => '2014-01-01',
            'Stundenpool_von' => '2014-01-10',
            'Stundenpool_bis' => '2014-12-23',
            'Stundensatz' => '135.00',
            'Stundenpools_Waehrungen_ID' => '1',
            'Anzahl_Stunden' => '30',
            'Rechnungsnummer' => 'RE-SP23423887',
            'Rechnungsdatum' => '2014-02-06',
            'Stundenpools_Wartungsvertraege_ID' => '1',
            'Stundenpools_OS_Stundenpools_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
