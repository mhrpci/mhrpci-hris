<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('push_notification_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type');
            $table->string('endpoint');
            $table->timestamp('sent_at');
            $table->integer('ttl');
            $table->string('urgency');
            $table->string('topic');
            $table->timestamps();

            $table->index(['user_id', 'type']);
            $table->index('sent_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('push_notification_logs');
    }
};
