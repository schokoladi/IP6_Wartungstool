<?php

use Illuminate\Database\Seeder;

/**
* Die UserTableSeeder-Klasse füllt die User-Tabelle mit den angegebenen Werten
*/
class UserTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('users')->delete();
    DB::table('users')->insert([
      [
        'name' => 'Dominik Schoch',
        'username' => 'dschoch',
        'email' => 'dominik.schoch@students.fhnw.ch',
        'role' => '1~Sekretär/in',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Jan Schnider',
        'username' => 'jschnider',
        'email' => 'jan.schnider@students.fhnw.ch',
        'role' => '2~Kundenverantwortliche/r',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Mathias Schnydrig',
        'username' => 'mschnydrig',
        'email' => 'mathias.schnydrig@amanox.ch',
        'role' => '2~Kundenverantwortliche/r',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Daniel Jossen',
        'username' => 'djossen',
        'email' => 'daniel.jossen@amanox.ch',
        'role' => '3~CEO',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Sekretär/in',
        'username' => 'sekretaer',
        'email' => 'sekretaer_in@amanox.ch',
        'role' => '1~Sekretär/in',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Kundenverantwortliche/r',
        'username' => 'kundenverantwortlicher',
        'email' => 'kundenverantwortlicher@amanox.ch',
        'role' => '2~Kundenverantwortliche/r',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'CEO',
        'username' => 'ceo',
        'email' => 'CEO@amanox.ch',
        'role' => '3~CEO',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ]
    ]);
  }
}
