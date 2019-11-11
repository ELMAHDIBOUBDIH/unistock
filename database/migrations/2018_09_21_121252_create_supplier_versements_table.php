<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierVersementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_versements', function (Blueprint $table) {
            $table->increments('id');

            $table->string('n_versement', 50);
            $table->date('date', 50);
            $table->boolean('valide')->default(false);
            $table->decimal('solde', 50, 2)->default(0);
            $table->decimal('versement', 50, 2)->default(0);
            $table->decimal('reste', 50, 2)->default(0);
            $table->string('n_cheque', 50);
            $table->text('note')->nullable();

            $table->integer('id_compte')->unsigned()->nullable();
            $table->foreign('id_compte')
                    ->references('id')->on('comptes')
                    ->onDelete('cascade');

            $table->integer('id_mode')->unsigned()->nullable();
            $table->foreign('id_mode')
                    ->references('id')->on('payment_modes')
                    ->onDelete('cascade');


            $table->integer('ref_id')->unsigned()->nullable();
            $table->foreign('ref_id')
                    ->references('id')->on('purchases')
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
        Schema::dropIfExists('supplier_versements');
    }
}
