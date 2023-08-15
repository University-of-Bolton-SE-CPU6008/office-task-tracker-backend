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
        Schema::create('user_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('leave_type');
            $table->string('request_text');
            $table->string('from_date');
            $table->string('to_date');
            $table->string('half_day');
            $table->string('reviewed_by');
            $table->string('review_comment');
            $table->string('inform_to');
            $table->string('days_count');
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_leaves');
    }
};
