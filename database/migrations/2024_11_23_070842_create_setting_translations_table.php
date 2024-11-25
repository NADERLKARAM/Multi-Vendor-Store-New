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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->unsignedInteger('setting_id'); // Foreign key to settings table
            $table->string('locale'); // Locale (e.g., 'en', 'ar')
            $table->longText('value')->nullable(); // Translated value
            $table->timestamps(); // Created at and Updated at

            // Unique constraint to ensure one translation per locale per setting
            $table->unique(['setting_id', 'locale']);

            // Foreign key constraint
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_translations');
    }
};