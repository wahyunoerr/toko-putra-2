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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('stok');
            $table->decimal('hargaBeli', 10, 2);
            $table->decimal('hargaJual', 10, 2);
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('satuan_id');
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

            $table->foreign('jenis_id')->references('id')->on('jenis_barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuan_barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
