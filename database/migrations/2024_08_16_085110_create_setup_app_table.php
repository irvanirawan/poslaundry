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
        Schema::create('setup_app', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // pajak pb1
            $table->string('pajak_pb1')->nullable();
            // struk header 1 sampai 5
            $table->string('struk_header1')->nullable()->comment('header struk 1');
            $table->string('struk_header2')->nullable()->comment('header struk 2');
            $table->string('struk_header3')->nullable()->comment('header struk 3');
            $table->string('struk_header4')->nullable()->comment('header struk 4');
            $table->string('struk_header5')->nullable()->comment('header struk 5');
            // struk footer 1 sampai 5
            $table->string('struk_footer1')->nullable()->comment('footer struk 1');
            $table->string('struk_footer2')->nullable()->comment('footer struk 2');
            $table->string('struk_footer3')->nullable()->comment('footer struk 3');
            $table->string('struk_footer4')->nullable()->comment('footer struk 4');
            $table->string('struk_footer5')->nullable()->comment('footer struk 5');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_app');
    }
};
