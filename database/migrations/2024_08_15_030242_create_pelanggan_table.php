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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // add columns: kode, nama, alamat, telepon, crerated_by, updated_by
            $table->string('kode', 10)->unique();
            $table->string('nama', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('status', 10)->nullable()->default('aktif')->comment('aktif, nonaktif');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        $this->upSeeder();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }

    public function upSeeder(): void
    {
        $data = [
            ['kode' => 'PLG001', 'nama' => 'PT. ABC', 'alamat' => 'Jl. Raya No. 1', 'telepon' => '08123456789', 'status' => 'aktif'],
            ['kode' => 'PLG002', 'nama' => 'PT. DEF', 'alamat' => 'Jl. Raya No. 2', 'telepon' => '08123456789', 'status' => 'aktif'],
            ['kode' => 'PLG003', 'nama' => 'PT. GHI', 'alamat' => 'Jl. Raya No. 3', 'telepon' => '08123456789', 'status' => 'aktif'],
        ];
        DB::table('pelanggan')->insert($data);
    }
};
