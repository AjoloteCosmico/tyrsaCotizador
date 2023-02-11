<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeLJoistLoadingCapacitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_l_joist_loading_capacities', function (Blueprint $table) {
            $table->id();

            $table->integer('caliber');
            $table->integer('loading_capacity');
            $table->double('crossbar_length',8,2);
            $table->double('camber',8,2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_l_joist_loading_capacities');
    }
}
