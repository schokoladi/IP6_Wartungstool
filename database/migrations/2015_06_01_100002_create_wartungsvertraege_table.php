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
          $table->string('Vertragsnummer', 50);
          $table->text('Beschreibung')->nullable();
          $table->boolean('Inaktiv')->default(FALSE);
          $table->string('Zustaendigkeit', 50);

          $table->integer('Wartungsvertraege_Kunden_ID')->unsigned();
          $table->foreign('Wartungsvertraege_Kunden_ID')->references('ID')->on('Kunden');

          $table->integer('Wartungsvertraege_Kontaktpersonen_ID')->unsigned();
          $table->foreign('Wartungsvertraege_Kontaktpersonen_ID')->references('ID')->on('Kontaktpersonen');

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
