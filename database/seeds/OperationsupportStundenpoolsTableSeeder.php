<?php

use Illuminate\Database\Seeder;

class OperationsupportStundenpoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Operationsupport_Stundenpools')->delete();
      DB::table('Operationsupport_Stundenpools')->insert([
          [
            'Bezeichnung' => 'OS-SP',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
