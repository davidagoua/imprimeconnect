<?php

namespace App\Notifications;

use App\Events\Commanded;
use App\Models\Commande;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommandeCreated extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Commande $commande)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.'.$this->commande->client_nom)
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'commande_id'=>$this->commande->id,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
          'commande_id'=>$this->commande->id,
          'conseiller_name'=>$this->commande->conseiller->name,
          'infographiste_name'=>$this->commande->infographiste->name,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'commande_id'=>$this->commande->id,
            'conseiller_name'=>$this->commande->conseiller->name,
            'infographiste_name'=>$this->commande->infographiste->name,
        ]);
    }

    public function broadcastOn(): array
    {
        return [
          'App.User'
        ];
    }

    public function broadcastAs(): string
    {
        return 'commande.created';
    }

    public function handle(Commanded $commanded)
    {
        $this->commande = $commanded->commande;
    }
}
