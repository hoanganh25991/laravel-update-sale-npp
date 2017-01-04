<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->nullable(false);
            $table->integer('quanity')->nullable(false);
            $table->string('type')->nullable(false);
            $table->string('created_by')->nullable(false);

            /**
             * Foreign key map
             */
            $table->foreign('product_code')->references('code')->on('products');
            $table->foreign('created_by')->references('email')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
