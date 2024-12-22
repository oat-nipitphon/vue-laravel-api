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
        Schema::create('table_post_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->nullable();
            $table->string('type_img_path')->nullable();
            $table->string('type_img_name')->nullable();
            $table->binary('type_img_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_post_types');
    }
};
