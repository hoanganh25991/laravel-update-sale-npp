<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTablePriceProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->nullable(false);
            $table->double('price', 10, 2)->nullable(false);
            $table->string('type')->nullable(false);

            /**
             * Foreign key map
             */
            $table->foreign('product_code')->references('code')->on('products');
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
        Schema::dropIfExists('price_product');
    }
}
