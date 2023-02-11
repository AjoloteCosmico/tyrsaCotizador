<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeStructuralJoistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_structural_joists', function (Blueprint $table) {
            $table->id();

            $table->string('caliber',6);
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
        Schema::dropIfExists('type_structural_joists');
    }
}