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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
              ->constrained('orders')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreignId('product_id')
              ->constrained('products')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->decimal('precio', 6,2);
            $table->integer('cantidad');
            $table->decimal('total', 6,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
