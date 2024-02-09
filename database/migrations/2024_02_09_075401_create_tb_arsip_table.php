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
        Schema::create('tb_arsip', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->nullable()->constrained('users');
            $table->foreignUuid('id_type_document')->constrained('tb_type_document');
            $table->foreignUuid('id_year')->constrained('tb_year');
            $table->string('code_arsip');
            $table->string('file_arsip');
            $table->date('date_arsip');
            $table->text('description');
            $table->boolean('is_private')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_arsip');
    }
};
