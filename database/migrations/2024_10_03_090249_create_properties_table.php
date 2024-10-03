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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->enum('type', ['rent', 'sale']);
            $table->string('main_image');
            $table->string('first_image');
            $table->string('second_image');
            $table->string('third_image');
            $table->string('fourth_image')->nullable();
            $table->string('fifth_image')->nullable();
            $table->text('description');
            $table->string('contact_info');
            $table->string('email');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
