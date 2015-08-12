<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
* Die DatabaseSeeder-Klasse wird beim Ausführen von db:seed aufgerufen und führt
* all hier enthaltenen Seeding-Klassen aus.
*/
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Tabelle User mit Werten füllen
        $this->call('UserTableSeeder');
        $this->command->info('user table seeded!');

        // Tabelle Waehrungen mit Werten füllen
        $this->call('WaehrungenTableSeeder');
        $this->command->info('Waehrungen table seeded!');

        // Tabelle Maintenances (Wartungen) mit Werten füllen
        $this->call('MaintenanceTableSeeder');
        $this->command->info('Maintenance table seeded!');

        // Tabelle Operationsupports mit Werten füllen
        $this->call('OperationsupportTableSeeder');
        $this->command->info('Operation Supports table seeded!');

        // Tabelle OS-Stundenpools mit Werten füllen
        $this->call('OperationsupportStundenpoolsTableSeeder');
        $this->command->info('OS-Stundenpools table seeded!');

        // ------ Fakultative Seeding mit Testdaten ------

        // Tabelle Hersteller mit Werten füllen
        $this->call('HerstellerTableSeeder');
        $this->command->info('Hersteller table seeded!');

        // Tabelle Produkte mit Werten füllen
        $this->call('ProdukteTableSeeder');
        $this->command->info('Produkte table seeded!');

        // Tabelle Kunden mit Werten füllen
        $this->call('KundenTableSeeder');
        $this->command->info('Kunden table seeded!');

        // Tabelle Kontaktpersonen mit Werten füllen
        $this->call('KontaktpersonenTableSeeder');
        $this->command->info('Kontaktpersonen table seeded!');

        // Tabelle Wartungsvertraege mit daten füllen
        $this->call('WartungsvertraegeTableSeeder');
        $this->command->info('Wartungsvertraege table seeded!');

        // Tabelle Stundenpools mit daten füllen
        $this->call('StundenpoolsTableSeeder');
        $this->command->info('Stundenpools table seeded!');

        // Tabelle Artikel mit daten füllen
        $this->call('ArtikelTableSeeder');
        $this->command->info('Artikel table seeded!');

        Model::reguard();
    }
}
