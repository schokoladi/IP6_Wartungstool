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

              $table->double('Stundensatz', 10, 2);
              $table->integer('Stundensatz_Waehrungen_ID')->unsigned();
              $table->foreign('Stundensatz_Waehrungen_ID')->references('ID')->on('Waehrungen');
              $table->integer('Anzahl_Stunden');

              $table->string('Rechnungsnummer');
              $table->date('Rechnungsdatum');

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
