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
        Schema::create('companions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade');
            $table->string('name_kr');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['MR', 'MS', 'MSTR', 'MISS', 'INF'])->nullable();
            $table->string('name_en')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companions');
    }
};
