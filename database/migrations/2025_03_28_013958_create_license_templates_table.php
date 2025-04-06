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
        Schema::create('license_templates', function (Blueprint $table) {
            $table->id();
            $table->string('license_type'); // lisence name
            $table->integer('max_devices')->default(1);
            $table->string('application')->nullable(); // application name
            $table->integer('daily_generation_limit')->default(1000);
            $table->integer('workers')->default(1);
            $table->string('version')->nullable();
            $table->integer('active_days')->nullable()->default(30)->comment('Number of days the license is active');
            $table->decimal('price', 8, 2)->nullable()->default(0.00)->comment('Price of the license');
            $table->boolean('is_trial')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_templates');
    }
};
