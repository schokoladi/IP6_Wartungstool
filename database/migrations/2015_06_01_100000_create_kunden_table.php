<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKundenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Kunden'))
        {
          Schema::create('Kunden', function (Blueprint $table) {
              $table->increments('ID');

              $table->string('Name');
              $table->string('Adresse', 100);
              $table->string('PLZ'); // TODO: Einschränkunge? integer, 4?
              $table->string('Ort', 50);
              // TODO: weitere Kundenattribute je nach Inntact-Export

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
        Schema::drop('Kunden');
    }
}
