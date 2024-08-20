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
        Schema::create('penjualan_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('penjualan_id')->nullable()->comment('relasi tabel penjualan');
            $table->unsignedBigInteger('item_id')->nullable()->comment('relasi tabel item');
            $table->integer('qty')->nullable()->comment('jumlah item yang di beli');
            $table->integer('harga')->nullable()->comment('harga item saat penjualan');
            $table->integer('total_harga')->nullable()->comment('total harga item saat penjualan (qty * harga)');
            $table->text('keterangan')->nullable()->comment('keterangan item penjualan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('user yang melakukan penjualan');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('user yang melakukan update penjualan');
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('set null');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_items');
    }
};
