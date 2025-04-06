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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('license_type'); // lisence name
            $table->string('license_key')->unique();
            $table->json('devices_mac')->nullable(); // can be more than 1
            $table->integer('max_devices')->default(1);
            $table->timestamp('valid_until')->nullable();
            $table->string('application')->nullable(); // application name
            $table->tinyInteger('status')->nullable()->default(4); // Default to pending (4)
            // Status codes:
            // 0: active
            // 1: inactive
            // 2: expired
            // 3: revoked
            // 4: pending
            $table->timestamp('purchase_date')->nullable();
            $table->timestamp('activation_date')->nullable();
            $table->integer('daily_generation_limit')->default(value: 0);
            $table->integer('workers')->default(1);
            $table->text('notes')->nullable();
            $table->string('version')->nullable();
            $table->integer('active_days')->nullable()->default(30)->comment('Number of days the license is active');
            $table->boolean('is_trial')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
