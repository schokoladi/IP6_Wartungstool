<?php

use Illuminate\Database\Seeder;

class ArtikelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('Artikel')->delete();
      DB::table('Artikel')->insert([
          [
            'Artikel_Produkte_ID' => '1',
            'Seriennummer' => 'TRINC-GRID-21321312313',
            'EKP_Artikel' => '10000',
            'EKP_Artikel_Waehrungen_ID' => '1',
            'VKP_Artikel' => '15000',
            'VKP_Artikel_Waehrungen_ID' => '1',
            'Auftragsnummer' => 'AT-23423423424',
            'Auftragsdatum' => '2012-04-05',
            'Rechnungsnummer' => 'RE-23423424324',
            'Rechnungsdatum' => '2012-06-20',
            'Artikel_Maintenances_ID' => '1',
            'Maintenance_Start' => '2013-01-01',
            'Maintenance_von' => '2013-01-20',
            'Maintenance_bis' => '2013-11-20',
            'EKP_Maintenance' => '1000',
            'EKP_Maintenance_Waehrungen_ID' => '1',
            'VKP_Maintenance' => '1300',
            'VKP_Maintenance_Waehrungen_ID' => '1',
            'Artikel_OperationSupports_ID' => '1',
            'OperationSupport_von' => '2013-01-01',
            'OperationSupport_bis' => '2015-12-31',
            'VKP_Operationsupport' => '1',
            'VKP_Operationsupport_Waehrungen_ID' => '1',
            'Artikel_Wartungsvertraege_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ],
          [
            'Artikel_Produkte_ID' => '1',
            'Seriennummer' => 'TRINC-GRID-78987978',
            'EKP_Artikel' => '20000',
            'EKP_Artikel_Waehrungen_ID' => '1',
            'VKP_Artikel' => '27000',
            'VKP_Artikel_Waehrungen_ID' => '1',
            'Auftragsnummer' => 'AT-23423423424',
            'Auftragsdatum' => '2012-04-05',
            'Rechnungsnummer' => 'RE-23423424324',
            'Rechnungsdatum' => '2012-06-20',
            'Artikel_Maintenances_ID' => '3',
            'Maintenance_Start' => '2013-01-01',
            'Maintenance_von' => '2013-01-20',
            'Maintenance_bis' => '2013-11-20',
            'EKP_Maintenance' => '1300',
            'EKP_Maintenance_Waehrungen_ID' => '1',
            'VKP_Maintenance' => '1700',
            'VKP_Maintenance_Waehrungen_ID' => '1',
            'Artikel_OperationSupports_ID' => '3',
            'OperationSupport_von' => '2013-01-01',
            'OperationSupport_bis' => '2015-12-31',
            'VKP_Operationsupport' => '1',
            'VKP_Operationsupport_Waehrungen_ID' => '1',
            'Artikel_Wartungsvertraege_ID' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
          ]
      ]);
    }
}
