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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade');

            $table->string('product_name')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();

            $table->unsignedInteger('adult_count')->nullable();
            $table->unsignedInteger('child_count')->nullable();
            $table->unsignedInteger('infant_count')->nullable();

            $table->unsignedInteger('adult_price')->nullable();
            $table->unsignedInteger('child_price')->nullable();
            $table->unsignedInteger('infant_price')->nullable();

            $table->unsignedInteger('total_price')->nullable();

            $table->boolean('is_airfare_included')->default(false);
            $table->unsignedInteger('airfare')->nullable();
            $table->unsignedInteger('land_cost')->nullable();
            $table->unsignedInteger('service_fee')->nullable();
            $table->string('vendor')->nullable();

            $table->unsignedInteger('deposit_amount')->nullable();
            $table->date('deposit_date')->nullable();
            $table->string('deposit_method')->nullable();

            $table->unsignedInteger('middle_payment_amount')->nullable();
            $table->date('middle_payment_date')->nullable();
            $table->string('middle_payment_method')->nullable();

            $table->unsignedInteger('final_payment_amount')->nullable();
            $table->date('final_payment_date')->nullable();
            $table->string('final_payment_method')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
