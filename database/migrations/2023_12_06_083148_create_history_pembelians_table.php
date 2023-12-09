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
        Schema::create('history_pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('jenis');
            $table->integer('harga_bahan');
            $table->integer('harga_jasa');
            $table->integer('jumlah_barang');
            $table->integer('jumlah_bayar');
            $table->integer('kembalian');
            $table->integer('total');
            $table->string('tipe_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_pembelians');
    }
};
