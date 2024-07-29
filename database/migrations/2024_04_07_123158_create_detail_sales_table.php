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
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
            ->protected('products');

            $table->foreignId('sale_id')
              ->constrained('sales')
              ->onDelete('cascade')
              ->onUpdate('cascade');

           $table->decimal('precio', 8,2);
           $table->integer('cantidad');
           $table->decimal('total', 8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sales');
    }
};
