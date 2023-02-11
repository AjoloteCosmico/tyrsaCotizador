<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorReinforcementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_reinforcements', function (Blueprint $table) {
            $table->id();

            $table->double('length',8,4);
            $table->double('weight',8,4);
            $table->double('m2',8,4);
            $table->string('sku');
            $table->decimal('price',8,2);
            
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
        Schema::dropIfExists('floor_reinforcements');
    }
}
