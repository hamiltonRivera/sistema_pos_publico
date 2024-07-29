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
        Schema::create('historial_facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('numFactura');
            $table->date('fecha');
            $table->string('descripcion');
            $table->decimal('monto', 8,2);

            $table->foreignId('client_id')
              ->constrained('clients')
              ->onDelete('cascade')
              ->onUpdate('cascade');

              $table->foreignId('user_id')
               ->constrained('users')
               ->onDelete('cascade')
               ->onUpdate('cascade');

            $table->string('metodoPago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_facturas');
    }
};
