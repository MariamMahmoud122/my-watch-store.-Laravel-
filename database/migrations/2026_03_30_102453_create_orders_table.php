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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name'); // اسم الزبون
        $table->string('phone');         // رقم تليفونه
        $table->text('address');         // عنوانه
        $table->decimal('total_price', 10, 2); // إجمالي الحساب
        $table->string('status')->default('pending'); // حالة الطلب
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
