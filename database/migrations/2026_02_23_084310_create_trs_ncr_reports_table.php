<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trs_ncr_reports', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->char('idncr', 10)->primary();

            $table->string('report_number', 25)->unique();

            $table->char('idsession', 10)->nullable();
            $table->char('iddepartments', 6);
            $table->char('lead_auditor_id', 6);

            $table->string('actual_submitter_name', 100)->nullable();

            // FIXED
            $table->unsignedBigInteger('idclauses');

            $table->char('idcategories', 6);

            $table->date('audit_date');
            $table->string('audit_location', 200)->nullable();

            $table->enum('status', [
                'ENTRY',
                'ON_PROGRESS',
                'IN_REVIEW',
                'CLOSED'
            ])->default('ENTRY');

            $table->enum('is_locked', ['0','1'])->default('0');
            $table->enum('is_disputed', ['0','1'])->default('0');

            $table->char('closed_by', 6)->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->text('close_remarks')->nullable();

            $table->char('reopened_by', 6)->nullable();
            $table->timestamp('reopened_at')->nullable();
            $table->text('reopen_reason')->nullable();

            $table->enum('isactive', ['0','1'])->default('1');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
        });

        Schema::table('trs_ncr_reports', function (Blueprint $table) {

            $table->foreign('idsession')
                ->references('idsession')
                ->on('trs_schedule_session')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('iddepartments')
                ->references('iddepartments')
                ->on('mst_departments')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('lead_auditor_id')
                ->references('idauditor')
                ->on('mst_auditor')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('idclauses')
                ->references('idclauses')
                ->on('mst_iso_clauses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('idcategories')
                ->references('idcategories')
                ->on('mst_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('closed_by')
                ->references('idauditor')
                ->on('mst_auditor')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('reopened_by')
                ->references('idauditor')
                ->on('mst_auditor')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trs_ncr_reports');
    }
};