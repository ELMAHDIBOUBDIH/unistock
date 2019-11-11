<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->string('purchase_number', 50);
            $table->string('type', 50);
            $table->date('date');
            $table->decimal('total_tva', 15, 2)->default(0);
            $table->decimal('total_ht', 15, 2)->default(0);
            $table->decimal('total_ttc', 15, 2)->default(0);
            $table->decimal('remise', 15, 2)->default(0);
            $table->boolean('valide')->default(false);
            $table->longText('note')->nullable();

            $table->integer('ref_id')->unsigned()->nullable();
            $table->foreign('ref_id')
                    ->references('id')
                    ->on('purchases');

            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')
                    ->references('id')->on('suppliers')
                    ->onDelete('cascade');

            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')
                    ->references('id')->on('employees')
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
        Schema::dropIfExists('purchases');
    }
}
