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
        Schema::create('mst_department_default_clause', function (Blueprint $table) {
            $table->increments('id');
            $table->char('iddepartments', 6);
            $table->char('idclauses', 6);

            // framework
            $table->timestamp('created_at')->useCurrent();
            $table->string('user_create')->nullable();

            // foreign key
            $table->foreign('iddepartments')->references('iddepartments')->on('mst_departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idclauses')->references('idclauses')->on('mst_iso_clauses')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['iddepartments', 'idclauses'], 'dept_clause_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_department_default_clause');
    }
};
