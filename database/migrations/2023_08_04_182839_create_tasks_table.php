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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('task_type_id');
            $table->string('task_detail');
            $table->string('date');
            $table->integer('number_of_hour');
            $table->text('comment');
            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('task_type_id')->references('id')->on('task_types');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
