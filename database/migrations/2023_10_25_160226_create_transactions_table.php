<?php

use App\Enums\TransactionStatusType;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->char('id', 17)->primary();
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users');
            $table->integer('unique_code');
            $table->string('orderer_name');
            $table->string('phone_number');
            $table->text('address');
            $table->date('date');
            $table->enum('status', TransactionStatusType::getValues())
                ->default(TransactionStatusType::WaitingForPayment);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
