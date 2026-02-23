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
        Schema::create('mst_fishbone_factors', function (Blueprint $table) {
            $table->char('idfishbone', 6)->primary();
            $table->string('code', 5)->unique();
            $table->string('name', 50)->comment('English: Human, Material, etc');
            $table->string('name_id', 50)->comment('Indonesian: Manusia, Material, dll');
            $table->text('examples')->nullable();
            $table->string('icon', 50)->nullable();
            $table->integer('display_order')->default(0);

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
        Schema::dropIfExists('mst_fishbone_factors');
    }
};
