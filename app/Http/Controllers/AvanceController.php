<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\Commande;
use Illuminate\Http\Request;

class AvanceController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create(Request $request, Commande $commande)
    {
        return $this->edit($request, $commande);
    }

    public function edit(Request $request,Commande $commande)
    {
        return view('avances.edit', [
            'commande'=>$commande
        ]);
    }

    public function store(Request $request, Commande $commande)
    {
        return $this->update($request, $commande);
    }

    public function update(Request $request, Commande $commande)
    {
        $data = $request->validate([
            'montant'=>'required'
        ]);
        $avance = new Avance(['montant'=>$data['montant'], 'user_id'=> auth()->id(), 'commande_id'=>$commande->id]);
        $avance->save();

        activity()
            ->performedOn($commande)
            ->withProperty('montant', $data['montant'])
            ->causedBy(auth()->user())->log('Enregistré une avance');

        return back()->with('success','Avance enregistrée');
    }

    public function delete(Request $request, Avance $avance)
    {
        $avance->delete();
        activity()
            ->performedOn($avance)
            ->causedBy(auth()->user())->log('Supprimé une avance');
        return back()->with('success','Avance supprimée');
    }
}
