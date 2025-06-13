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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->date('consulted_at'); // 상담일
            $table->string('agent')->nullable(); // 담당자
            $table->string('status')->nullable(); // 진행상태
            $table->string('referral_path')->nullable(); // 방문경로

            $table->string('region')->nullable(); // 희망지역
            $table->string('product_name')->nullable(); // 상품명
            $table->date('departure_date')->nullable(); // 출발일
            $table->date('return_date')->nullable(); // 도착일
            $table->string('stay_nights')->nullable(); // 숙박일수 표현 (예: 5박 6일)

            $table->boolean('is_honeymoon')->default(false);
            $table->date('wedding_date')->nullable();
            $table->string('wedding_hall')->nullable();
            $table->text('honeymoon_memo')->nullable();

            $table->unsignedInteger('adult_price')->nullable(); // 1인 가격
            $table->unsignedInteger('child_price')->nullable();
            $table->unsignedInteger('infant_price')->nullable();
            $table->boolean('is_airfare_included')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
