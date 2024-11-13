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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('id_stock');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity')->default(0);
            $table->enum('type_moved', ['check_in']);
            $table->timestamps();

            $table->foreign('id_product')
                    ->references('id_product')
                    ->on('products')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
