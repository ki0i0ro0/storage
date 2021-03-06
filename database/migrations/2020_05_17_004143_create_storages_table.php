<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_leavings', function (Blueprint $table) {
            $table->increments('seq_no');       
            $table->integer('stock_no');
            $table->integer('product_no');
            $table->integer('selling');
            $table->timestamps();            
        });  

        Schema::create('t_stocks', function (Blueprint $table) {
            $table->integer('stock_no');
            $table->integer('product_no');
            $table->integer('cost');
            $table->integer('selling')->nullable();
            $table->timestamps();
        });      
        
        Schema::create('t_storings', function (Blueprint $table) {
            $table->increments('seq_no');
            $table->integer('stock_no')->nullable();
            $table->integer('product_no');
            $table->integer('cost');
            $table->timestamps();
        });           

        Schema::create('m_products', function (Blueprint $table) {
            $table->integer('product_no');
            $table->integer('product_name')->nullable();
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
        Schema::dropIfExists('storages');
    }
}
