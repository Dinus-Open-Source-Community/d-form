<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('short_uuid', 8)->unique();
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->enum('semester', ['1', '3']);
            $table->string('nomor_hp');
            $table->string('email_pribadi');
            $table->string('email_mahasiswa');
            $table->enum('divisi_utama', ['Pemrograman', 'Jaringan', 'Medcrev', 'Data']);
            $table->json('divisi_tambahan');
            $table->string('cv');
            $table->string('portofolio')->nullable();
            $table->string('bukti_follow_instagram');
            $table->string('bukti_follow_linkedin')->nullable();
            $table->string('username_instagram');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};