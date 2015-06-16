<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWartungsvertraegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Wartungsvertraege'))
      {
        Schema::create('Wartungsvertraege', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('Vertragsnummer');
          $table->text('Beschreibung')->nullable();
          /*$table->boolean('Status')->default(TRUE);

          // unsigned ist notwendig bei Fremdschlüsseln!
          $table->integer('Kunden_ID')->unsigned();
          $table->foreign('Kunden_ID')->references('ID')->on('Kunden');
          $table->integer('Kontaktpersonen_ID')->unsigned();
          $table->foreign('Kontaktpersonen_ID')->references('ID')->on('Kontaktpersonen');*/

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
        Schema::drop('Wartungsvertraege');
    }
}
