<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dispatch(Request $request)
    {
        switch (true){
            case auth()->user()->hasRole('admin'):
                return $this->admin_dashboard($request);
                break;
            case auth()->user()->hasRole('reception'):
                return $this->admin_dashboard($request);
                break;
            case auth()->user()->hasRole('designer'):
                return $this->admin_dashboard($request);
                break;
            case auth()->user()->hasRole('finition'):
                return $this->admin_dashboard($request);
                break;
            case auth()->user()->hasRole('conseiller'):
                return $this->admin_dashboard($request);
                break;
            default:
                return abort(401);
        }
    }

    public function admin_dashboard(Request $request)
    {
        $commandes = Commande::query()->get();
        $nb_commandes = $commandes->count();
        $montant = $commandes->sum(fn($commande)=> $commande->montant);
        $nb_clients = $commandes->groupBy(fn($commande)=> $commande->contact)->count();
        $commande_by_format = $commandes->groupBy(fn($commande)=> $commande->format);

        return view('dashboards.admin',
            compact('nb_commandes','montant','nb_clients')
        );
    }

    public function secretary_dashboard(Request $request)
    {

    }

    public function designer_dashboard(Request $request)
    {

    }

    public function finition_dashboard(Request $request)
    {

    }

    public function conseiller_dashboard(Request $request)
    {

    }
}
