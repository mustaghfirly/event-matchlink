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
     Schema::create('sponsorships', function (Blueprint $table) {
        $table->id();

        $table->foreignId('event_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('company_id')
              ->constrained()
              ->onDelete('cascade');

        $table->decimal('nominal', 15, 2)->nullable();

        $table->enum('status', [
            'pending',
            'accepted',
            'rejected'
        ])->default('pending');

        $table->text('catatan')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};
