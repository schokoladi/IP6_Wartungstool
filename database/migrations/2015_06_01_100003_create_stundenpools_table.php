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
              $table->integer('Stundenpools_Waehrungen_ID')->unsigned();
              $table->foreign('Stundenpools_Waehrungen_ID')->references('ID')->on('Waehrungen');
              $table->integer('Anzahl_Stunden'); // TODO: integer oder double?

              $table->string('Rechnungsnummer');
              $table->date('Rechnungsdatum');

              $table->integer('Stundenpools_Wartungsvertraege_ID')->unsigned();
              $table->foreign('Stundenpools_Wartungsvertraege_ID')->references('ID')->on('Wartungsvertraege');

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
