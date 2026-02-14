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
        Schema::create('menfess_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menfess_id')->constrained('menfesses')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reporter
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menfess_reports');
    }
};
