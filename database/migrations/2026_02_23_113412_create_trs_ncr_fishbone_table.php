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
       Schema::create('trs_ncr_fishbone', function (Blueprint $table) {

$table->increments('id');
    $table->char('idncr', 10);
    $table->char('idfishbone', 6);

    $table->enum('is_selected', ['0','1'])->default('1')->nullable(false);
    $table->text('notes')->nullable();

    $table->timestamp('created_at')->useCurrent();
    $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

    $table->string('user_create')->nullable();
    $table->string('user_update')->nullable();

    $table->unique(['idncr','idfishbone']);

    $table->foreign('idncr')
        ->references('idncr')
        ->on('trs_ncr_reports')
        ->cascadeOnDelete()
        ->cascadeOnUpdate();

    $table->foreign('idfishbone')
        ->references('idfishbone')
        ->on('mst_fishbone_factors')
        ->cascadeOnDelete()
        ->cascadeOnUpdate();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_ncr_fishbone');
    }
};
