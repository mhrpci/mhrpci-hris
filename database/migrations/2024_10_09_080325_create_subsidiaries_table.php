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
        Schema::create('subsidiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbr');
            $table->text('description');
            $table->string('tagline');
            $table->string('contact_no')->nullable();
            $table->string('email_address')->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('wesite')->nullable();
            $table->string('main_image');
            $table->string('first_image')->nullable();
            $table->string('second_image')->nullable();
            $table->string('third_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsidaries');
    }
};
