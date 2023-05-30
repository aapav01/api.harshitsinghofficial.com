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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->ulid('id');
            $table->float('bought_price');
            $table->string('payment_method')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['paid', 'pending']);
            $table->foreignUlid('user_id')->index()->onDelete('cascade');
            $table->foreignUlid('course_id')->index()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
