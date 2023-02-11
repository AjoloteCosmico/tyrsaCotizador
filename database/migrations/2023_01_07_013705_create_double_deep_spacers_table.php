<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('double_deep_spacers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quotation_id');
            $table->foreign('quotation_id')
                ->references('id')
                ->on('quotations');
            $table->integer('amount')->nullable();
            $table->string('use')->nullable();
            $table->double('developing',8,4)->nullable();
            $table->double('long',8,4)->nullable();
            $table->string('caliber')->nullable();
            $table->double('kg_m2',8,4)->nullable();
            $table->double('m2',8,4)->nullable();
            $table->string('sku')->nullable();
            $table->decimal('unit_price',8,2)->nullable();
            $table->decimal('total_price',8,2)->nullable();
            
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
        Schema::dropIfExists('double_deep_spacers');
    }
};
