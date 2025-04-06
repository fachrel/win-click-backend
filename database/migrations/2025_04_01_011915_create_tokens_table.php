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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->text('access_token');
            $table->timestamp('expires')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('visibility')->default(0); // 0 false, 1 true
            $table->tinyInteger('status')->default(0); // 0 dead, 1 active
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
