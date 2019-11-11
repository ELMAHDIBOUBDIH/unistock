<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_outputs', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['sale','internal_movement']);
            $table->integer('quantity');

            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                    ->references('id')->on('products')
                    ->onDelete('cascade');

            $table->integer('warehouse_id')->unsigned()->nullable();
            $table->foreign('warehouse_id')
                    ->references('id')->on('warehouses')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('warehouse_outputs');
    }
}
