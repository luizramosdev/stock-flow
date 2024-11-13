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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id('id_checkout');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_stock');
            $table->integer('quantity')->default(0);
            $table->date('date_moved');
            $table->enum('type_moved', ['checkout']);
            $table->timestamps();

            $table->foreign('id_product')
            ->references('id_product')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('id_stock')
            ->references('id_stock')
            ->on('stocks')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
