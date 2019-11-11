<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_products', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('quantity', 50, 2);
            $table->decimal('quantity_reserved', 50, 2);
            $table->string('zone')->nullable();
            $table->string('shelf')->nullable();
            $table->text('note')->nullable();

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
        Schema::dropIfExists('warehouse_products');
    }
}
