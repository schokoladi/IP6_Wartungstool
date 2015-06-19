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

        $this->call('WaehrungenTableSeeder');
        $this->command->info('Waehrungen table seeded!');

        $this->call('MaintenancesTableSeeder');
        $this->command->info('Maintenances table seeded!');

        $this->call('OperationSupportsTableSeeder');
        $this->command->info('Operation Supports table seeded!');


        Model::reguard();
    }
}
