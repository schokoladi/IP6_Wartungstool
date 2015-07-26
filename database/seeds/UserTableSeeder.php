<?php

use Illuminate\Database\Seeder;

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
        'role' => 'Sekretär/in',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Jan Schnider',
        'username' => 'jschnider',
        'email' => 'jan.schnider@students.fhnw.ch',
        'role' => 'Kundenverantwortliche/r',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Mathias Schnydrig',
        'username' => 'mschnydrig',
        'email' => 'mathias.schnydrig@amanox.ch',
        'role' => 'Kundenverantwortliche/r',
        'password' => Hash::make('w4rtungst00l'),
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ],
      [
        'name' => 'Daniel Jossen',
        'username' => 'djossen',
        'email' => 'daniel.jossen@amanox.ch',
        'password' => Hash::make('w4rtungst00l'),
        'role' => 'CEO',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ]
    ]);
  }
}
