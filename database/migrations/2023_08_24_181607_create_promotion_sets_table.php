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
        Schema::create('promotionset', function (Blueprint $table) {
            $table->id();
            $table->integer("stid");
            $table->integer("setnumber");
            $table->string("grade");
            $table->integer("year")->default(date('Y')); // Set default to current year
            $table->integer("cdate")->default(intval(date('Ymd'))); // Set default to current date as YYYYMMDD
            $table->time("ctime")->default(date('H:i:s')); // Set default to current time
            $table->integer("status")->default(1);
            $table->integer("tid");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotionset');
    }
};
