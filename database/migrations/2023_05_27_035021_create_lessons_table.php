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
        Schema::create('lessons', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->float('length')->nullable();
            $table->string('url')->nullable();
            $table->string('thumb_url')->nullable();
            $table->boolean('public')->default(false);
            $table->integer('position')->default(1);
            $table->enum('type', ['video', 'audio', 'document', 'pdf', 'image', 'quiz']);
            $table->enum('status', ['preparing', 'processing', 'success', 'failure'])->default('preparing');
            $table->enum('platform', [
                'Youtube', 'SoundCloud', 'Facebook', 'Vimeo',
                'Twitch', 'Streamable', 'Wistia', 'DailyMotion',
                'Mixcloud', 'Vidyard', 'Kaltura', 'Files'
            ])->nullable();
            $table->foreignUuid('user_id')->index()->onDelete('cascade');
            $table->foreignUuid('chapter_id')->nullable()->index()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
