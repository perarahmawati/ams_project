<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @param mixed $value
     */

    public function up(): void
    {
        Schema::create('data_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_name')->constrained('item_names');
            $table->unsignedBigInteger('manufacture_name')->constrained('manufacture_names');
            $table->string('serial_number')->nullable();
            $table->unsignedBigInteger('configurationstatus_name')->constrained('configurationstatus_names');
            $table->unsignedBigInteger('location_name')->constrained('location_names');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tables');
    }
};
