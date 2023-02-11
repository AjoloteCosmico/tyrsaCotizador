<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeL25JoistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_l25_joists', function (Blueprint $table) {
            $table->id();

            $table->integer('caliber');
            $table->double('length',8,2);
            $table->double('weight',8,4);
            $table->double('m2',8,4);
            $table->double('camber',8,4);
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
        Schema::dropIfExists('type_l25_joists');
    }
}
