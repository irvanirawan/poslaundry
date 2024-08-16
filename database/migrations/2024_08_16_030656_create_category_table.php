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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('category_group_id')->nullable();
            $table->string('kode', 10)->unique();
            $table->string('nama', 50)->nullable();
            $table->string('status', 10)->nullable()->default('aktif')->comment('aktif, nonaktif');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category_group_id')->references('id')->on('category_group')->onDelete('set null');
        });

        $this->upSeeder();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }

    public function upSeeder(): void
    {
        $data = [
            ['kode' => 'C001', 'nama' => 'Category 1', 'status' => 'aktif'],
            ['kode' => 'C002', 'nama' => 'Category 2', 'status' => 'aktif'],
            ['kode' => 'C003', 'nama' => 'Category 3', 'status' => 'aktif'],
        ];
        DB::table('category')->insert($data);
    }
};
