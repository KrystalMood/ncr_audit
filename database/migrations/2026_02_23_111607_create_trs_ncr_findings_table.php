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
        Schema::create('trs_ncr_findings', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->char('idfindings', 10)->primary();

            $table->char('idncr', 10);

            $table->text('problem');
            $table->text('location');
            $table->text('objective');
            $table->text('reference');

            $table->text('evidence_description')->nullable();

            $table->enum('isactive', ['0','1'])->default('1');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();

            $table->foreign('idncr')
                ->references('idncr')
                ->on('trs_ncr_reports')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_ncr_findings');
    }
};