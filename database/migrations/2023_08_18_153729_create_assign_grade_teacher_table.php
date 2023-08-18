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
        Schema::create('assign_grade_teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('centerId');
            $table->integer('teacherId');
            $table->integer('userId');
            $table->integer('status')->default(1);
            $table->integer('sdnumber')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_grade_teachers');
    }
};
