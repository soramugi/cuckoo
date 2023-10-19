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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->time('time')->index();
            $table->integer('day')->nullable();
            $table->integer('week')->nullable();
            $table->string('title');
            $table->boolean('once')->default(false);
            $table->text('description')->nullable();
            $table->string('to');
            $table->dateTime('compleded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
