<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsupportStundenpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('Operationsupport_Stundenpools'))
        {
          Schema::create('Operationsupport_Stundenpools', function (Blueprint $table) {
              $table->increments('ID');

              $table->string('Bezeichnung');

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
        Schema::drop('Operationsupport_Stundenpools');
    }
}
