<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('company_name',50);
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->enum('gender', ['female','male']);
            $table->dateTime('birthday')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('email',50)->unique();
            $table->string('address',50)->nullable();
            $table->string('image',50)->nullable();
            $table->string('qualification',50)->nullable();
            $table->date('recruitment_date')->nullable();
            $table->string('password',50);
            $table->longText('note')->nullable();            

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
        Schema::dropIfExists('employees');
    }
}
