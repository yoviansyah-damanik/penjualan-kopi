<?php

use App\Enums\PaymentStatusType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->char('transaction_id', 17)
                ->references('id')
                ->on('transactions');
            $table->char('payment_vendor_id', 6)
                ->references('id')
                ->on('payment_vendors');
            $table->text('image')->nullable();
            $table->enum('status', PaymentStatusType::getValues())
                ->default(PaymentStatusType::WaitingForConfirmation);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
