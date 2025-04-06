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
        Schema::create('generation_logs', function (Blueprint $table) {
            $table->id();
            $table->text('prompts');
            $table->string('email');
            $table->integer('generated_image_count')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('aspect_ratio')->nullable();
            $table->string('seed')->nullable();
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generation_logs');
    }
};
