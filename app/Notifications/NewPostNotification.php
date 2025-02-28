<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Post;

class NewPostNotification extends Notification
{
    use Queueable;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'New Announcement Posted',
            'message' => "A new announcement '{$this->post->title}' has been posted.",
            'post_id' => $this->post->id,
            'type' => 'post',
            'icon' => 'fas fa-bullhorn',
            'url' => route('posts.show', $this->post->id)
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'title' => 'New Announcement Posted',
            'message' => "A new announcement '{$this->post->title}' has been posted.",
            'post_id' => $this->post->id,
            'type' => 'post',
            'icon' => 'fas fa-bullhorn',
            'url' => route('posts.show', $this->post->id)
        ];
    }
} 