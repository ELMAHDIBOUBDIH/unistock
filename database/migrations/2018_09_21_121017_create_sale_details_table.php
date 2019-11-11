<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('unit_price', 15, 2);
            $table->decimal('quantity', 15, 2);
            $table->decimal('tva_rate', 15, 2);
            $table->decimal('montant_ttc', 15, 2);

            $table->integer('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')
                    ->references('id')->on('sales')
                    ->onDelete('cascade');

            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                    ->references('id')->on('products')
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
        Schema::dropIfExists('sale_details');
    }
}
