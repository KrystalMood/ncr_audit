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
        Schema::create('trs_ncr_corrections', function (Blueprint $table) {

            $table->char('idcorrections', 10)->primary();
            $table->char('idncr', 10);

            $table->string('actual_submitter_name', 100)->nullable();

            $table->text('root_cause_analysis')->nullable();

            $table->text('why_1')->nullable();
            $table->text('why_2')->nullable();
            $table->text('why_3')->nullable();
            $table->text('why_4')->nullable();
            $table->text('why_5')->nullable();

            $table->text('correction')->nullable();
            $table->date('correction_date')->nullable();

            $table->text('corrective_action')->nullable();
            $table->string('corrective_pic_name', 100)->nullable();
            $table->date('corrective_due_date')->nullable();
            $table->date('corrective_completed_date')->nullable();

            $table->text('preventive_action')->nullable();
            $table->string('preventive_pic_name', 100)->nullable();
            $table->date('preventive_due_date')->nullable();
            $table->date('preventive_completed_date')->nullable();

            $table->text('effectiveness_review')->nullable();
            $table->enum('is_effective', ['0','1'])->nullable();

            $table->enum('effectiveness_can_reopen', ['0','1'])->default('1')->nullable(false);

            $table->char('reviewed_by', 6)->nullable();
            $table->timestamp('reviewed_at')->nullable();

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

            $table->foreign('reviewed_by')
                ->references('idauditor')
                ->on('mst_auditor')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_ncr_corrections');
    }
};
