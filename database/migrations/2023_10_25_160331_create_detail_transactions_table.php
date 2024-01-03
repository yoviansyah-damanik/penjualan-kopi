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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->char('transaction_id', 17)
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
            $table->char('product_id', 13)
                ->references('id')
                ->on('products');
            $table->integer('qty');
            $table->double('price');
            $table->double('cost');
            $table->double('discount')
                ->default(0);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
