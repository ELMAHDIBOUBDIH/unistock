<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('reference');
            $table->string('designation');
            $table->string('code_barre');
            $table->string('unit');
            $table->decimal('cond')->default(1);
            $table->decimal('tva', 4, 2)->default(0);
            $table->boolean('product_facturable')->default(true);
            $table->boolean('product_perissable')->default(false);
            $table->dateTime('date_p')->nullable();
            $table->dateTime('alert_p')->nullable();
            $table->enum('etat', ['actif','sommeil'])->default('actif');
            $table->string('image', 50)->nullable();
            $table->decimal('price_ht',15, 2)->default(0);
            $table->decimal('price_ttc',15, 2)->default(0);
            $table->decimal('last_price',15, 2)->default(0);
            $table->decimal('pmp',15, 2)->default(0);
            $table->decimal('qnt_initial',15, 2)->default(0);
            $table->decimal('alert_stock', 15, 2)->default(0);
            $table->boolean('pack')->default(false);
            $table->decimal('qnt_pack', 15, 2)->default(0);
            $table->decimal('price_pack',15, 2)->default(0);
            $table->decimal('price_unit_pack',15, 2)->default(0);
            $table->text('note');

            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')
                    ->references('id')->on('brands')
                    ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('cascade');

            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')
                    ->references('id')->on('suppliers')
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
        Schema::dropIfExists('products');
    }
}
