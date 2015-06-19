<?php

use Illuminate\Database\Seeder;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Maintenances')->delete();
      DB::table('Maintenances')->insert([
          [
              'Maintenance' => 'M',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Maintenance' => 'M3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Maintenance' => 'M5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Maintenance' => 'EM',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Maintenance' => 'EM3',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Maintenance' => 'EM5',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
