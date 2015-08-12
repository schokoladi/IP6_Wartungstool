<?php

use Illuminate\Database\Seeder;

/**
* Die MaintenanceTableSeeder-Klasse füllt die Maintenance-Tabelle mit den angegebenen Werten
*/
class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Maintenance')->delete();
      DB::table('Maintenance')->insert([
          [
              'Bezeichnung' => 'M',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'M3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'M5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EM',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EM3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EM5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
