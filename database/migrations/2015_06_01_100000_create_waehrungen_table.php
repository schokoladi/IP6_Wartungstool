<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaehrungenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Waehrungen'))
        {
          Schema::create('Waehrungen', function (Blueprint $table) {
              $table->increments('ID');
              
              $table->string('Waehrung', 3); // CHF, USD, EUR..

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
        Schema::drop('Waehrungen');
    }
}
