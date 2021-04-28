<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->integer('project_id')->references('id')->on('projects');
            $table->integer('employee_id')->references('id')->on('employees');
            $table->integer('client_id')->references('id')->on('clients');
            $table->string('name_client');
            $table->string('project');
            $table->string('description');
            $table->double('hours_per_week');
            $table->double('total_time');
            $table->date('date');
            $table->string('user');
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
        Schema::dropIfExists('time_sheets');
    }
}
