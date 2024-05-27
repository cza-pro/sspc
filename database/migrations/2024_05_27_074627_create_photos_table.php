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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('generate_number');
            $table->integer('subject_id');
            $table->integer('grade_id');
            $table->integer('topic_id');
            $table->enum('public', ['on', 'off'])->default('on');
            $table->string('photo_url')->nullable();
            $table->string('photo_type')->nullable();
            $table->string('photo_format')->nullable();
            $table->string('photo_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
