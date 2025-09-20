<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('username_instagram');
            $table->text('catatan')->nullable()->after('status');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('catatan');
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
            $table->softDeletes(); 
            
            
            $table->foreign('reviewed_by')->references('id')->on('users')->nullOnDelete();
            
            // Index untuk performance
            $table->index(['status', 'divisi_utama']);
            $table->index(['created_at', 'status']);
            $table->index('deleted_at');
        });
    }

    public function down(): void
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropIndex(['status', 'divisi_utama']);
            $table->dropIndex(['created_at', 'status']);
            $table->dropIndex('deleted_at');
            $table->dropSoftDeletes();
            $table->dropColumn(['status', 'catatan', 'reviewed_by', 'reviewed_at']);
        });
    }
};