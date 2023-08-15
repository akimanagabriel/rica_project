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
        Schema::create('gradecourse', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('cid');
            $table->foreign('cid')->references('id')->on('course')->constrained()->onDelete('cascade');
            $table->string('gid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gradecourse');
    }
};
