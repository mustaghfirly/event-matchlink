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
            Schema::table('users', function (Blueprint $table) {
        $table->enum('role', [
            'admin',
            'panitia',
            'perusahaan'
        ])->default('panitia');

        $table->string('phone')->nullable();
        $table->string('photo')->nullable();
    });
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->string('nama_event');
        $table->string('kategori');
        $table->text('deskripsi');

        $table->string('proposal')->nullable();

        $table->decimal('target_dana', 15, 2);

        $table->date('tanggal_event');

        $table->string('lokasi');

        $table->enum('status', [
            'pending',
            'approved',
            'rejected'
    ])->default('pending');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'role',
            'phone',
            'photo'
        ]);
    });
    }
};
