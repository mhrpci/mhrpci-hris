<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedHiringsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_hirings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hiring_id');
            $table->string('ip_address', 45);
            $table->timestamps();

            $table->foreign('hiring_id')->references('id')->on('hirings')->onDelete('cascade');
            $table->unique(['hiring_id', 'ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_hirings');
    }
}
