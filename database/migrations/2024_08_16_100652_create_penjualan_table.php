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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode_penjualan', 10)->unique();
            $table->unsignedBigInteger('pelanggan_id')->nullable()->comment('relasi tabel pelanggan');
            $table->integer('total_harga')->nullable()->comment('total harga penjualan sebelum diskon atau potongan harga (belum termasuk pajak)');
            $table->integer('total_item')->nullable()->comment('total item penjualan (jumlah item yang di beli)');
            $table->integer('total_bayar')->nullable()->comment('total bayar dari pelanggan');
            $table->integer('total_kembalian')->nullable()->comment('total kembalian ke pelanggan');
            $table->string('status', 50)->nullable()->comment('status penjualan (lunas, belum lunas, dp, dll)');
            $table->integer('diskon')->nullable()->comment('diskon atau potongan harga');
            $table->integer('pajak')->nullable()->comment('pajak penjualan');
            $table->integer('total_harga_final')->nullable()->comment('total harga penjualan setelah diskon dan pajak');
            $table->text('keterangan')->nullable()->comment('keterangan penjualan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('user yang melakukan penjualan');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('user yang melakukan update penjualan');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
