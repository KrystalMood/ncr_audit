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
        Schema::create('mst_schedule_header', function (Blueprint $table) {
            $table->char('idschedule', 6)->primary();
            $table->string('title', 200)->comment('Judul jadwal audit');
            $table->char('year', 4)->comment('Tahun periode: 2025');
            $table->enum('type', ['internal', 'external'])->default('internal');
            $table->date('start_date')->comment('Tanggal mulai periode audit');
            $table->date('end_date')->comment('Tanggal selesai periode audit');
            $table->date('ncr_deadline')->nullable()->comment('Batas input NCR');
            $table->enum('status', ['draft', 'active', 'completed', 'cancelled'])->default('draft');
            $table->text('notes')->nullable();

            // framework
            $table->enum('isactive', ['0', '1'])->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_schedule_header');
    }
};
