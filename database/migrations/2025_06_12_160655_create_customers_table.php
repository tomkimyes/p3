<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name_kr');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['MR', 'MS', 'MSTR', 'MISS', 'INF'])->nullable();
            $table->string('name_en')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->text('history')->nullable();
            $table->text('memo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
