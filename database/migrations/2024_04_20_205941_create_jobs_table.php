<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('jobPosiiton')->unsigned();
            $table->integer('workPlace')->unsigned();
            $table->text('country');
            $table->integer('state')->unsigned();
            $table->integer('city')->unsigned();
            $table->integer('company')->unsigned();
            $table->integer('employeementType')->unsigned();
            $table->text('skills');
            $table->string('totalVacancy');
            $table->date('deadline');
            $table->string('minSalary');
            $table->string('maxSalary');
            $table->integer('salaryType')->unsigned();
            $table->integer('experience')->unsigned();
            $table->integer('education')->unsigned();
            $table->string('promote');
            $table->text('description');
            $table->integer('status')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
