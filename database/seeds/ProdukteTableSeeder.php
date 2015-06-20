<?php

use Illuminate\Database\Seeder;

class ProdukteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Produkte')->delete();
      DB::table('Produkte')->insert([
          [
            'Artikelnummer' => 'TE-810-NS1GRID-AC',
            'Name' => 'Trinzic 810',
            'Produkte_Hersteller_ID' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikelnummer' => 'TE-820-NS1GRID-AC',
            'Name' => 'Trinzic 820',
            'Produkte_Hersteller_ID' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikelnummer' => 'TE-1420-NS1GRID-AC',
            'Name' => 'Trinzic 1420',
            'Produkte_Hersteller_ID' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikelnummer' => 'IB-1102-A-MRI',
            'Name' => 'Infoblox Grid',
            'Produkte_Hersteller_ID' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikelnummer' => 'SUB-DYNATRACE-PROD',
            'Name' => 'dynaTrace Production Edition',
            'Produkte_Hersteller_ID' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikelnummer' => 'ADAudit Plus 5 File Server',
            'Name' => 'Active Directory Audit',
            'Produkte_Hersteller_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
