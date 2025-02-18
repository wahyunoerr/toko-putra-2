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
        Schema::create('pos_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pos_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('quantity');
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();

            $table->foreign('pos_id')->references('id')->on('pos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_details');
    }
};
