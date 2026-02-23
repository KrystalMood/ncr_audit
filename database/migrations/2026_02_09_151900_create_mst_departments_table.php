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
        Schema::create('mst_departments', function (Blueprint $table) {
            $table->char('iddepartments', 6)->primary();
            $table->char('kode_utama', 3)->unique()->comment('Kode 3 digit: 100, 200, dkk');
            $table->string('prefix', 5)->unique()->comment('Prefix: MK1, HR1, dkk');
            $table->string('name', 100)->nullable();
            $table->string('pic_name', 100)->nullable()->comment('Nama kepala departemen');

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
        Schema::dropIfExists('mst_departments');
    }
};
