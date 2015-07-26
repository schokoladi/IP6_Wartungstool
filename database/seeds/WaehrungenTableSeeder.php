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
              'Kurs' => '1',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Waehrung' => 'EUR',
              'Kurs' => '0.9538',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ],
          [
              'Waehrung' => 'USD',
              'Kurs' => '1.0429',
              'created_at' => new DateTime,
              'updated_at' => new DateTime
          ]
      ]);
    }
}
