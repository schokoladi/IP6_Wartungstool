<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontaktpersonenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Kontaktpersonen'))
        {
          Schema::create('Kontaktpersonen', function (Blueprint $table) {
              $table->increments('ID');

              $table->string('Vorname', 50);
              $table->string('Name', 50);

              // Verknüpfung mit Kunden
              $table->integer('Kontaktpersonen_Kunden_ID')->unsigned();
              $table->foreign('Kontaktpersonen_Kunden_ID')->references('ID')->on('Kunden');
              // Weitere Attribute gemäss Inntact-Export

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
        Schema::drop('Kontaktpersonen');
    }
}
