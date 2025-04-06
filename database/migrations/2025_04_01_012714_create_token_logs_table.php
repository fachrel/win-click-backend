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
        Schema::create('token_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->date('generation_date');
            $table->integer('generation_count')->default(0);
            $table->timestamps();

            $table->index(['email', 'generation_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_logs');
    }
};
