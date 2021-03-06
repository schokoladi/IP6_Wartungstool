<?php

use Illuminate\Database\Seeder;

class HerstellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Hersteller')->delete();
      DB::table('Hersteller')->insert([
          [
            'Name' => 'ManageEngine',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Name' => 'Compuware',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Name' => 'Infoblox',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
