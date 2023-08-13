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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('regnumber');
            $table->string('name');
            $table->string('fname');
            $table->string('fphone');
            $table->string('mname');
            $table->string('ophone');
            $table->string('gender');
            $table->string('address');
            $table->enum('status', ['0', '1'])->default('0');
            $table->UnsignedBigInteger('userid');
            $table->string('cdate');
            $table->string('province');
            $table->integer('district');
            $table->string('sector');
            $table->string('cell');
            $table->string('village');
            $table->string('comment');
            $table->string('grade');
            $table->string('year');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
