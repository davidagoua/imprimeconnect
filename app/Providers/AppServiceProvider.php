<?php

namespace App\Providers;

use App\Models\Commande;
use App\Models\Ligne;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $commandes_design = Ligne::query()->whereStatus('design')->count();
        $commandes_finition = Ligne::query()->whereStatus('finition')->count();
        View::share('commandes_design', $commandes_design);
        View::share('commandes_finition', $commandes_finition);

    }
}
