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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade');
            $table->string('no_telp');
            $table->string('status')->default('kosong');
            $table->string('alamat');
            $table->string('ktp');
            $table->datetime('checkin_date');
            $table->datetime('checkout_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
