<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trs_ncr_reports', function (Blueprint $table) {

            // WAJIB untuk FK stabil
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // PRIMARY KEY
            $table->char('idncr', 10)->primary();

            $table->string('report_number', 25)->unique()
                ->comment('Auto generate: XXX.YYY.DEP.M.TT');

            // RELATION
            $table->char('idsession', 10)->nullable()
                ->comment('Link ke sesi audit');

            $table->char('iddepartments', 6)
                ->comment('Departemen yang diaudit');

            $table->char('lead_auditor_id', 6)
                ->comment('Lead Auditor');

            $table->string('actual_submitter_name', 100)->nullable()
                ->comment('Nama input sebenarnya');

            $table->char('idclauses', 6);
            $table->char('idcategories', 6);

            $table->date('audit_date');
            $table->string('audit_location', 200)->nullable();

            // STATUS WORKFLOW
            $table->enum('status', [
                'ENTRY',
                'ON_PROGRESS',
                'IN_REVIEW',
                'CLOSED'
            ])->default('ENTRY');

            $table->enum('is_locked', ['0','1'])->default('0');
            $table->enum('is_disputed', ['0','1'])->default('0');

            // CLOSE
            $table->char('closed_by', 6)->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->text('close_remarks')->nullable();

            // REOPEN
            $table->char('reopened_by', 6)->nullable();
            $table->timestamp('reopened_at')->nullable();
            $table->text('reopen_reason')->nullable();

            $table->enum('isactive', ['0','1'])->default('1');

            // TIMESTAMP SESUAI ERD
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
        });

        // FOREIGN KEY DIPISAH SETELAH CREATE (lebih aman)
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