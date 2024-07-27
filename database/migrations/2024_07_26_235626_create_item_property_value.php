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
        Schema::create('item_property_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('property_value_id');
            $table->primary(['item_id', 'property_value_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_property_value');
    }
};
