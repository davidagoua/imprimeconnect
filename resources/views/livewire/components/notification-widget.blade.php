<li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle  nav-link-lg beep">
        <i class="far fa-bell text-white "></i>
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
            <div class="float-right">
                <a href="e.preventDefault()" wire:click.prevent="increment">Mark All As Read</a>
            </div>
        </div>
            <div class="dropdown-list-content dropdown-list-icons">
        @foreach($notifications as $notif)
            @if($notif->type === 'App\Notifications\CommandeCreated')
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dropdown-item-desc">
                        Nouvelle commande #{{ $notif->data['commande_id'] }}
                        <div class="time text-primary">{{ now()->sub($notif->created_at)  }}</div>
                    </div>
                </a>
            @endif
        @endforeach
            </div>
        <div class="dropdown-footer text-center">
            <a href="#">Voir tout <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>
