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
        Schema::create('mst_categories', function (Blueprint $table) {
            $table->char('idcategories', 6)->primary();
            $table->string('code', 10)->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('severity_level')->nullable()->comment('1=Low, 2=Medium, 3=High');
            $table->text('description')->nullable();
            $table->string('color_hex', 7)->nullable();

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
        Schema::dropIfExists('mst_categories');
    }
};
