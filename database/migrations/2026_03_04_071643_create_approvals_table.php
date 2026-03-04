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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();

            // Relasi ke pemesanan kendaraan
            $table->foreignId('vehicle_order_id')
                ->constrained('vehicle_orders')
                ->cascadeOnDelete();

            // User yang menyetujui
            $table->foreignId('approver_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Level persetujuan (1, 2, 3, ...)
            $table->unsignedTinyInteger('level');

            // Status persetujuan
            $table->enum('status', [
                'PENDING',
                'APPROVED',
                'REJECTED'
            ])->default('PENDING');

            // Waktu keputusan
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            // Catatan dari approver
            $table->text('note')->nullable();

            $table->timestamps();

            // Cegah duplikasi level dalam satu order
            $table->unique(['vehicle_order_id', 'level']);

            // Index untuk performa
            $table->index(['approver_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
