<?php

use Illuminate\Database\Seeder;

/**
* Die OperationsupportTableSeeder-Klasse füllt die Operationsupport-Tabelle mit
* den angegebenen Werten
*/
class OperationsupportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Operationsupport')->delete();
      DB::table('Operationsupport')->insert([
          [
              'Bezeichnung' => 'OS',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'OS3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'OS5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EOS',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EOS3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Bezeichnung' => 'EOS5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
