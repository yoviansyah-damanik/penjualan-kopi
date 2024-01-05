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
        Schema::create('shippings', function (Blueprint $table) {
            $table->char('transaction_id', 17)
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
            $table->string('courier');
            $table->bigInteger('origin_id');
            $table->string('origin');
            $table->bigInteger('city_id');
            $table->string('city');
            $table->bigInteger('province_id');
            $table->string('province');
            $table->double('cost');
            $table->integer('estimation_day');
            $table->string('note');
            $table->string('type');
            $table->double('weight');
            $table->text('payload');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
