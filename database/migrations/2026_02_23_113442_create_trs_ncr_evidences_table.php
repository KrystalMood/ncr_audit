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
       Schema::create('trs_ncr_evidences', function (Blueprint $table) {

    $table->char('idevidences', 10)->primary();
    $table->char('idncr', 10);

    $table->string('file_name', 255);
    $table->string('file_path', 500);
    $table->string('file_type', 50)->nullable();
    $table->integer('file_size')->nullable();
    $table->text('description')->nullable();

    $table->char('uploaded_by', 6);
    $table->timestamp('uploaded_at')->useCurrent();

    $table->enum('isactive', ['0','1'])->default('1')->nullable(false);

    $table->timestamp('created_at')->useCurrent();
    $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

    $table->string('user_create')->nullable();
    $table->string('user_update')->nullable();

    $table->foreign('idncr')
        ->references('idncr')
        ->on('trs_ncr_reports')
        ->cascadeOnDelete()
        ->cascadeOnUpdate();

    $table->foreign('uploaded_by')
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
        Schema::dropIfExists('trs_ncr_evidences');
    }
};
