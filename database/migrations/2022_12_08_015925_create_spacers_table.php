<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spacers', function (Blueprint $table) {
            $table->id();

            $table->string('use');
            $table->double('developing',8,4);
            $table->double('length',8,4);
            $table->integer('caliber');
            $table->double('kg_m2',8,4);
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
        Schema::dropIfExists('spacers');
    }
}
