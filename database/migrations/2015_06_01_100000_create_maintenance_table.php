<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Maintenance'))
        {
          Schema::create('Maintenance', function (Blueprint $table) {
              $table->increments('ID');

              $table->string('Bezeichnung', 20);

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
        Schema::drop('Maintenance');
    }
}
