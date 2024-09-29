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
        Schema::create('notify_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_po');
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('receiver');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify_logs');
    }
};
