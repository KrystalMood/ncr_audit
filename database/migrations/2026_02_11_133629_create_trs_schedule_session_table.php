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
        Schema::create('trs_schedule_session', function (Blueprint $table) {
            $table->char('idsession', 10)->primary();
            $table->char('idschedule', 6);
            $table->integer('session_no');
            $table->date('session_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->char('iddepartments', 6);
            $table->string('area_name', 100)->nullable();
            $table->string('pic_name', 100)->nullable();
            $table->enum('session_type', ['audit', 'open_meeting', 'closing_meeting'])->default('audit');
            $table->text('notes')->nullable();

            // framework
            $table->enum('isactive', ['0', '1'])->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();

            // foreign key
            $table->foreign('idschedule')->references('idschedule')->on('mst_schedule_header')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('iddepartments')->references('iddepartments')->on('mst_departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_schedule_session');
    }
};
