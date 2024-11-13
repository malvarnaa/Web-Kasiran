<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->string('nama_konsumen');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->integer('uang_pembeli');
            $table->integer('kembalian');
            $table->foreignId('pembayaran_id')->constrained('pembayarans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
