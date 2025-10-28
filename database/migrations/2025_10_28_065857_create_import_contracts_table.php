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
        Schema::create('import_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('contract_code')->unique();
            $table->date('signed_date');
            $table->date('delivery_expected')->nullable();
            $table->decimal('total_estimated', 15, 2)->default(0);
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->nullOnDelete(); // Ví dụ: trả sau 30 ngày
            $table->string('status')->default('active'); // active / completed / cancelled
            $table->string('file_path')->nullable(); // file hợp đồng scan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_contracts');
    }
};
