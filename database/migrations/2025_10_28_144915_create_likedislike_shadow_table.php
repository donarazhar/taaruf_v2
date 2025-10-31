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
        Schema::create('likedislike_shadow', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_progress')->nullable();
            $table->string('emailact')->nullable();
            $table->unsignedSmallInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likedislike_shadow');
    }
};