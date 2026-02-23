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
        Schema::create('mst_iso_clauses', function (Blueprint $table) {
            $table->char('idclauses', 6)->primary();
            $table->char('idstandards', 6);
            $table->string('clause_number', 20)->nullable();
            $table->string('clause_name', 200);
            $table->text('description')->nullable();
            $table->char('parent_id', 6)->nullable();
            $table->integer('level')->default(1);

            // framework
            $table->enum('isactive', ['0', '1'])->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();

            // foreign key
            $table->foreign('idstandards')->references('idstandards')->on('mst_iso_standards')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('idclauses')->on('mst_iso_clauses')->onDelete('set null')->onUpdate('cascade');
            $table->unique(['idstandards', 'clause_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_iso_clauses');
    }
};
