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
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên điều khoản (VD: Net 30, COD, Trả góp,...)
            $table->text('description')->nullable(); // Mô tả chi tiết (VD: "Thanh toán trong vòng 30 ngày")
            $table->integer('days')->nullable(); // Số ngày (nếu có: Net 30 -> 30)
            $table->boolean('is_default')->default(false); // Đánh dấu mặc định
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_terms');
    }
};
