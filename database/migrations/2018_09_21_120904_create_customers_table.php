<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('company_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->enum('gender', ['female','male']);
            $table->dateTime('birthday')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('address', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('image', 50)->nullable();
            $table->decimal('solde', 50, 2)->default(0);
            $table->decimal('solde_max', 50, 2)->default(0);
            $table->string('reg_com')->nullable();
            $table->string('mat_fisc')->nullable();
            $table->string('num_art')->nullable();
            $table->boolean('bloque')->default(false);
            $table->longText('note')->nullable();

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')
                    ->references('id')->on('customer_groups')
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
        Schema::dropIfExists('customers');
    }
}
