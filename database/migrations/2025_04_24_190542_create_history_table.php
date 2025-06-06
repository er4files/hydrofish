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
    Schema::create('history', function (Blueprint $table) {
        $table->id();
        $table->timestamp('timestamp');
        $table->integer('tds'); // Total Dissolved Solids
        $table->integer('turbidity'); // Turbidity in NTU
        $table->decimal('ph_air', 5, 2); // pH level of water
        $table->decimal('suhu_air', 5, 2); // Temperature of water
        $table->integer('tinggi_air'); // Water height in cm
        $table->timestamps(); // Add created_at and updated_at
    });
}

public function down()
{
    Schema::dropIfExists('history');
}

};
