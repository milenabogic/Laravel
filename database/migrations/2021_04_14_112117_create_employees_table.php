<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('id')->index();
            $tabel->string('last_name');
            $table->string('name_employee');
            $table->string('username');
            $table->string('email');
            $table->string('status');
            $table->string('role');
            $table->double('hours_per_week');
        });
    }

    /**
     * Reverse the migrations.
     *
    * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheets');
    }
}