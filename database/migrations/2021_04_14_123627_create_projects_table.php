<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id')->index();
            $table->integer('employee_id')->references('id')->on('employees');
            $table->integer('client_id')->references('id')->on('clients');
            $table->string('project');
            $table->string('name_client');
            $table->string('name_employee');
            $table->string('status_project');
            $table->string('archived_project');
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
        Schema::dropIfExists('projects');
    }
}
