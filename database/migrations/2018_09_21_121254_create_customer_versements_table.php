<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerVersementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_versements', function (Blueprint $table) {
            $table->increments('id');

            $table->string('n_versement', 50);
            $table->date('date_v', 50);
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
                    ->references('id')->on('sales')
                    ->onDelete('cascade');

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')
                    ->references('id')->on('customers')
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
        Schema::dropIfExists('customer_versements');
    }
}
