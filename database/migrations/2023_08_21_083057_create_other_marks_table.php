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
        Schema::create('othermarks', function (Blueprint $table) {
            $table->id();
            $table->integer('stid');
            $table->integer('courseid');
            $table->integer('gradeid');
            $table->integer('marks');
            $table->integer('term');
            $table->integer('status');
            $table->integer('userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('othermarks');
    }
};
