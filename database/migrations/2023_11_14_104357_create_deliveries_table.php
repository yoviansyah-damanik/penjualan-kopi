<?php

use App\Enums\DeliveryStatusType;
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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->char('transaction_id', 17)
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
            $table->text('code');
            $table->text('description')->nullable();
            $table->enum('status', DeliveryStatusType::getValues())
                ->default(DeliveryStatusType::OnDelivery);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
