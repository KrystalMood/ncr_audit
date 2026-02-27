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
      Schema::create('rpt_status_logs', function (Blueprint $table) {

    $table->increments('idlog');
    $table->char('idncr', 10);

    $table->enum('old_status', ['ENTRY','ON_PROGRESS','IN_REVIEW','CLOSED'])->nullable();
    $table->enum('new_status', ['ENTRY','ON_PROGRESS','IN_REVIEW','CLOSED']);

    $table->char('changed_by', 6);
    $table->text('change_reason')->nullable();

    $table->timestamp('created_at')->useCurrent();

    $table->foreign('idncr')
        ->references('idncr')
        ->on('trs_ncr_reports')
        ->cascadeOnDelete()
        ->cascadeOnUpdate();

    $table->foreign('changed_by')
        ->references('idauditor')
        ->on('mst_auditor')
        ->cascadeOnDelete()
        ->cascadeOnUpdate();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpt_status_logs');
    }
};
