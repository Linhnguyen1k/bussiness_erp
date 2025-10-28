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
        Schema::create('product_import_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_import_id')->constrained('product_imports')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->decimal('import_price', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->storedAs('quantity * import_price'); // tự động tính
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_import_items');
    }
};
