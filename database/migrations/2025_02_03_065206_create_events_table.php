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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->string('cover_event')->nullable();
            $table->text('address');
            $table->string('map_url')->nullable();
            $table->string('gform_url')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_days');
            $table->integer('participants');
            $table->enum('type', ['RKT', 'NON-RKT']);
            $table->enum('division', ['General', 'Programming', 'Multimedia', 'Networking'])->default('General');

            $table->date("start_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
