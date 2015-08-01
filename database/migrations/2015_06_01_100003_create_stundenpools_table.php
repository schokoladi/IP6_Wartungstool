<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStundenpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Stundenpools'))
        {
          Schema::create('Stundenpools', function (Blueprint $table) {
              $table->increments('ID');

              $table->date('Stundenpool_Start');
              $table->date('Stundenpool_von');
              $table->date('Stundenpool_bis');

              $table->decimal('Stundensatz', 10, 2);
              $table->integer('Stundensatz_Waehrungen_ID')->unsigned();
              $table->foreign('Stundensatz_Waehrungen_ID')->references('ID')->on('Waehrungen');
              $table->integer('Anzahl_Stunden'); // Integer oder Float (bzw. decimal)?

              $table->string('Rechnungsnummer', 100);
              $table->date('Rechnungsdatum');

              // Relation mit Wartungsvertrag
              $table->integer('Stundenpools_Wartungsvertraege_ID')->unsigned();
              $table->foreign('Stundenpools_Wartungsvertraege_ID')->references('ID')->on('Wartungsvertraege');

              // Relation mit Stundenpool-Art (OS-SP)
              $table->integer('Stundenpools_OS_Stundenpools_ID')->unsigned();
              $table->foreign('Stundenpools_OS_Stundenpools_ID')->references('ID')->on('Operationsupport_Stundenpools');

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
        Schema::drop('Stundenpools');
    }
}
