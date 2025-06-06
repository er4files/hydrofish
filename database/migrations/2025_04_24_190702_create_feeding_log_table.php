<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feeding_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->string('jadwal'); // Feeding schedule (morning or evening)
            $table->string('status'); // Status (successful or failed)
            $table->integer('jumlah_pakan'); // Amount of feed in grams
            $table->timestamps(); // Add created_at and updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('feeding_logs');
    }
    
};
