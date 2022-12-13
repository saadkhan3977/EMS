<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMailNotify extends Notification
{
    use Queueable;
 
    public $post;
 
    public function __construct($post)
    {
       $this->post = $post; //Catching New Post
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Hey user, New post availabe')
                    ->greeting('Hello' , 'Subscriber')
                    ->line('There is a new post , hope you will like it')
                    ->line('Post title : '.$this->post->title) //Send with post title
                    ->action('Read Post' , url(route('post' , $this->post->slug))) //Send with post url
                    ->line('Thank you for being with us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
