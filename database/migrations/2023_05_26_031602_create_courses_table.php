<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('short')->nullable();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('image');
            $table->float('latest_price');
            $table->float('before_price')->nullable();
            $table->boolean('public')->default(false);
            $table->dateTime('publish_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('user_id')->index()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
