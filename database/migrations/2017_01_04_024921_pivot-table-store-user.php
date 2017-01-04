<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotTableStoreUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('managed_by')->nullable(false);
            $table->string('store_code')->nullable(false);

            /**
             * Foreign key map
             */
            $table->foreign('managed_by')->references('email')->on('users');
            $table->foreign('store_code')->references('code')->on('stores');
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
        Schema::dropIfExists('store_user');
    }
}
