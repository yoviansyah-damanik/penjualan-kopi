<?php

use App\Enums\TransactionType;
use App\Enums\TransactionStatusType;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->char('id', 17)->primary();
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users');
            $table->integer('unique_code');
            $table->string('orderer_name');
            $table->string('phone_number')
                ->nullable();
            $table->text('address')
                ->nullable();;
            $table->date('date');
            $table->enum('status', TransactionStatusType::getValues())
                ->default(TransactionStatusType::WaitingForPayment);
            $table->enum('type', TransactionType::getValues())
                ->default(TransactionType::Ecommerce);
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
