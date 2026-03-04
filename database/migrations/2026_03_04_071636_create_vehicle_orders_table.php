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
        Schema::create('vehicle_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 30)->unique();
            // Relasi utama
            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->restrictOnDelete();
            $table->foreignId('driver_id')
                ->constrained('drivers')
                ->restrictOnDelete();

            $table->string('requester_name');
            $table->string('department');

            // Waktu pemesanan
            $table->date('booking_date');
            $table->date('return_date');

            $table->string('destination');
            $table->integer('passengers')->nullable();

            $table->enum('priority', ['normal', 'high', 'urgent'])->default('normal');

            $table->text('notes')->nullable();

            // Status global order
            $table->enum('status', [
                'PENDING',
                'IN_PROGRESS',
                'APPROVED',
                'REJECTED',
                'IN_USE',
                'COMPLETED'
            ])->default('PENDING');

            // Index tambahan
            $table->index(['vehicle_id', 'status']);
            $table->index(['booking_date', 'return_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_orders');
    }
};
