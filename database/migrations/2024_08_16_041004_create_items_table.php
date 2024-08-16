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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode', 50)->unique();
            $table->string('nama', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->unsignedBigInteger('kelompok_id')->nullable()->comment('kelompok kategori');
            $table->unsignedBigInteger('kategori_id')->nullable()->comment('kategori item atau barang');
            $table->string('satuan')->nullable()->comment('satuan item atau barang (pcs, kg, gram, liter, dll) atau bisa dibuatkan master satuan nanti isi nya tetap string hanya untuk membatasi inputan');
            $table->integer('hargajual')->nullable();
            $table->integer('hargamodal')->nullable();
            $table->integer('stok')->nullable();
            $table->integer('stokmin')->nullable();
            $table->integer('stokmax')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('kelompok_id')->references('id')->on('category_group')->onDelete('set null');
            $table->foreign('kategori_id')->references('id')->on('category')->onDelete('set null');
        });

        $this->upSeeder();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }

    public function upSeeder(): void
    {
        $data = [
            ['kode' => 'I001', 'nama' => 'Item 1', 'status' => 'aktif', 'kelompok_id' => 1, 'kategori_id' => 1, 'satuan' => 'pcs', 'hargajual' => 10000, 'hargamodal' => 5000, 'stok' => 100, 'stokmin' => 10, 'stokmax' => 1000, 'keterangan' => 'Item 1', 'gambar' => 'item1.jpg'],
            ['kode' => 'I002', 'nama' => 'Item 2', 'status' => 'aktif', 'kelompok_id' => 1, 'kategori_id' => 1, 'satuan' => 'pcs', 'hargajual' => 20000, 'hargamodal' => 10000, 'stok' => 200, 'stokmin' => 20, 'stokmax' => 2000, 'keterangan' => 'Item 2', 'gambar' => 'item2.jpg'],
            ['kode' => 'I003', 'nama' => 'Item 3', 'status' => 'aktif', 'kelompok_id' => 1, 'kategori_id' => 1, 'satuan' => 'pcs', 'hargajual' => 30000, 'hargamodal' => 15000, 'stok' => 300, 'stokmin' => 30, 'stokmax' => 3000, 'keterangan' => 'Item 3', 'gambar' => 'item3.jpg'],
        ];
        DB::table('items')->insert($data);
    }
};
