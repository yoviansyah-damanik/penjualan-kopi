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
        Schema::create('products', function (Blueprint $table) {
            $table->char('id', 13)->primary();
            $table->text('slug');
            $table->string('name');
            $table->double('price');
            $table->double('cost');
            $table->double('discount')
                ->default(0);
            $table->double('weight')
                ->default(1);
            $table->text('description');
            $table->char('category_id', 6)
                ->nullable()
                ->references('id')
                ->on('categories');
            $table->text('main_image')->nullable();
            $table->text('additional_images')->nullable();
            $table->boolean('is_ready')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
