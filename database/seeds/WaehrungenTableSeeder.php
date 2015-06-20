<?php

use Illuminate\Database\Seeder;

class WaehrungenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Waehrungen')->delete();
      DB::table('Waehrungen')->insert([
          [
              'Waehrung' => 'CHF',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Waehrung' => 'EUR',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Waehrung' => 'USD',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
