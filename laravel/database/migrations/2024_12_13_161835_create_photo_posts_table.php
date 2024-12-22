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
        Schema::create('photo_posts', function (Blueprint $table) {
            $table->id();                  
            $table->bigInteger('post_id')->constrained()->onDelete('cascade');
            $table->string('photo_path')->nullable();  
            $table->string('photo_name')->nullable();   
            $table->binary('photo_data')->nullable();   
            $table->timestamps();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_posts');
    }
};
