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
            $table->text('notification_text');
            $table->json('notification_details')->nullable();
            $table->string('environment')->default('production');
            $table->timestamps();

            // Create a unique compound index with a shorter custom name
            $table->index(['notification_type', 'notification_id', 'created_at'], 'sent_notif_lookup_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sent_notifications');
    }
};
