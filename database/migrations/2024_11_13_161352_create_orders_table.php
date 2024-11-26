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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('order_status_id')->constrained('order_statuses')->onDelete('cascade');
            $table->foreignId('payment_status_id')->constrained('payment_statuses')->onDelete('cascade');
            $table->decimal('igv', 10, 2);
            $table->decimal('sub_total', 10, 2);
            $table->text('descripcion')->nullable();
            $table->decimal('monto_adelanto', 10, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
