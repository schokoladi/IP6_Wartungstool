<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Produkte'))
        {
          Schema::create('Produkte', function (Blueprint $table) {
              $table->increments('ID');

              $table->string('Artikelnummer', 100);
              $table->string('Produktname', 150);

              $table->integer('Hersteller_ID')->unsigned();
              $table->foreign('Hersteller_ID')->references('ID')->on('Hersteller');

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
        Schema::drop('Produkte');
    }
}
