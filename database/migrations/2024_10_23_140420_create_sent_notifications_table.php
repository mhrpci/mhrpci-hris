<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sent_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notification_type');
            $table->string('notification_id');
            $table->timestamps();

            // Create a unique compound index
            $table->unique(['notification_type', 'notification_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sent_notifications');
    }
};
