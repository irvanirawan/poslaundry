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
        Schema::create('category_group', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode', 10)->unique();
            $table->string('nama', 50)->nullable();
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
        Schema::dropIfExists('category_group');
    }

    public function upSeeder(): void
    {
        $data = [
            ['kode' => 'CG001', 'nama' => 'Group 1', 'status' => 'aktif'],
            ['kode' => 'CG002', 'nama' => 'Group 2', 'status' => 'aktif'],
            ['kode' => 'CG003', 'nama' => 'Group 3', 'status' => 'aktif'],
        ];
        DB::table('category_group')->insert($data);
    }
};
