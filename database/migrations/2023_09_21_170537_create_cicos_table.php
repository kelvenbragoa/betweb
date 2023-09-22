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
        Schema::create('cicos', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_stevedor_id');
            $table->date('date');
            $table->time('time');
            $table->integer('type_cico_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cicos');
    }
};