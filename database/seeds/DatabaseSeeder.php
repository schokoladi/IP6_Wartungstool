<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        // $this->call('UserTableSeeder');
        //$this->call('WartungsvertraegeTableSeeder');
        //$this->command->info('Wartungsvertraege table seeded!');

        // Tabelle Waehrungen mit Werten füllen
        $this->call('WaehrungenTableSeeder');
        $this->command->info('Waehrungen table seeded!');

        // Tabelle Maintenances mit Werten füllen
        $this->call('MaintenancesTableSeeder');
        $this->command->info('Maintenances table seeded!');

        // Tabelle OperationSupports mit Werten füllen
        $this->call('OperationSupportsTableSeeder');
        $this->command->info('Operation Supports table seeded!');

        // Tabelle Hersteller mit Werten füllen
        $this->call('HerstellerTableSeeder');
        $this->command->info('Hersteller table seeded!');

        // Tabelle Produkte mit Werten füllen
        $this->call('ProdukteTableSeeder');
        $this->command->info('Produkte table seeded!');

        // Tabelle Produkte mit Werten füllen
        $this->call('KundenTableSeeder');
        $this->command->info('Kunden table seeded!');

        // Tabelle Produkte mit Werten füllen
        $this->call('KontaktpersonenTableSeeder');
        $this->command->info('Kontaktpersonen table seeded!');

        Model::reguard();
    }
}
