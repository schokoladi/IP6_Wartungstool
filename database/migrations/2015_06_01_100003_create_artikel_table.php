<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Artikel'))
        {
          Schema::create('Artikel', function (Blueprint $table) {
              $table->increments('ID');

              // Produkt
              $table->integer('Artikel_Produkte_ID')->unsigned();
              $table->foreign('Artikel_Produkte_ID')->references('ID')->on('Produkte');
              $table->string('Seriennummer', 100)->unique();

              // Artikel
              $table->double('EKP_Artikel', 20, 2); // 20 total, 2 after decimal
              $table->integer('EKP_Artikel_Waehrungen_ID')->unsigned();
              $table->foreign('EKP_Artikel_Waehrungen_ID')->references('ID')->on('Waehrungen');
              $table->double('VKP_Artikel', 20, 2);
              $table->integer('VKP_Artikel_Waehrungen_ID')->unsigned();
              $table->foreign('VKP_Artikel_Waehrungen_ID')->references('ID')->on('Waehrungen');

              $table->string('Auftragsnummer', 100);
              $table->date('Auftragsdatum'); // nur Dautm benötigt, Zeit nicht
              $table->string('Rechnungsnummer', 100);
              $table->date('Rechnungsdatum');

              // Maintenance
              $table->integer('Artikel_Maintenance_ID')->unsigned();
              $table->foreign('Artikel_Maintenance_ID')->references('ID')->on('Maintenance');
              $table->date('Maintenance_Start');
              $table->date('Maintenance_von');
              $table->date('Maintenance_bis');

              $table->double('EKP_Maintenance', 20, 2);
              $table->integer('EKP_Maintenance_Waehrungen_ID')->unsigned();
              $table->foreign('EKP_Maintenance_Waehrungen_ID')->references('ID')->on('Waehrungen');
              $table->double('VKP_Maintenance', 20, 2);
              $table->integer('VKP_Maintenance_Waehrungen_ID')->unsigned();
              $table->foreign('VKP_Maintenance_Waehrungen_ID')->references('ID')->on('Waehrungen');

              // Operationsupport
              $table->integer('Artikel_Operationsupport_ID')->unsigned()->nullable();
              $table->foreign('Artikel_Operationsupport_ID')->references('ID')->on('Operationsupport');
              $table->date('Operationsupport_Start')->nullable();
              $table->date('Operationsupport_von')->nullable();
              $table->date('Operationsupport_bis')->nullable();
              $table->double('VKP_Operationsupport', 20, 2)->nullable();
              $table->integer('VKP_Operationsupport_Waehrungen_ID')->unsigned()->nullable();
              $table->foreign('VKP_Operationsupport_Waehrungen_ID')->references('ID')->on('Waehrungen');

              $table->integer('Artikel_Wartungsvertraege_ID')->unsigned();
              $table->foreign('Artikel_Wartungsvertraege_ID')->references('ID')->on('Wartungsvertraege');

              $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Artikel');
    }
}
