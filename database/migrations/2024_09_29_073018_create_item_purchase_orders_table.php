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
        Schema::create('item_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_po');
            $table->unsignedBigInteger('material_id');
            $table->integer('qty')->default('0');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_purchase_orders');
    }
};
