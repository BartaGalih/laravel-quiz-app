<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->enum('type', ['document', 'video']); // document = PDF/pages, video = mp4
            $table->string('file_path')->nullable();      // path to uploaded file
            $table->string('video_url')->nullable();      // YouTube / uploaded video URL
            $table->integer('page_count')->nullable();    // for documents
            $table->integer('duration_seconds')->nullable(); // for videos
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_materials');
    }
};
