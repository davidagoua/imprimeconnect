<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Ligne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LigneController extends Controller
{
    public function index_design(Request $request)
    {
        if(! auth()->user()->hasRole('admin')){
            $lignes = Ligne::query()
                //->whereStatus('design')
                ->whereRelation('commande','infographiste_id', auth()->id())->get();
        }   else{
            $lignes = Ligne::query()
                //->whereStatus('design')
                ->get();
        }
        return view('lignes.index_design', [
            'lignes'=> $lignes
        ]);
    }

    public function store_design(Request $request, Ligne $ligne)
    {
        if(! auth()->user()->hasanyrole('admin|designer')){
            return abort(401);
        }
        $validator = Validator::make($request->file(), [
            'fichier'=>'required'
        ]);

        if($validator->fails()){
            return back()->with('error','Veuiller remplir correctement le champs');
        }
        $ligne->nom_fichier = $request->file('fichier')->store('designs');
        $ligne->status = 'finition';
        Commande::query()->firstWhere('id', $ligne->commande_id)->update(['status'=>'finition']);
        $ligne->save();

        return redirect()->route('commandes.design')->with('success', 'Fichier enregistré');
    }

    public function index_finition(Request $request)
    {
        if(! auth()->user()->hasRole('admin')){
            $lignes = Ligne::query()
                //->whereStatus('finition')
                ->get();
        }   else{
            $lignes = Ligne::withoutGlobalScope('actif')
                //->whereStatus('finition')
                ->get();
        }
        return view('lignes.index_finition', [
            'lignes'=> $lignes
        ]);
    }

    public function delete(Ligne $ligne)
    {
        $ligne->update(['deleted_at'=>now()]);
        return back()->with('success', 'Fichier supprimée');
    }

    public function revert(Ligne $ligne)
    {
        if($ligne->status = 'finition'){
            $ligne->status = 'design';
            Commande::query()->firstWhere('id', $ligne->commande_id)->update(['status'=>'design']);
            $ligne->save();
        }elseif ($ligne->status = 'termine'){
            $ligne->status = 'finition';
            Commande::query()->firstWhere('id', $ligne->commande_id)->update(['status'=>'finition']);
            $ligne->save();
        }
        return back()->with('success', "Commande enrégistré");
    }

    public function edit(Request $request, Ligne $ligne)
    {
        return view('lignes.edit', compact('ligne'));
    }

    public function terminer(Ligne $ligne)
    {
        $ligne->status = 'termine';
        Commande::query()->firstWhere('id', $ligne->commande_id)->update(['status'=>'termine']);
        $ligne->save();
        return back()->with('success', "Commande enrégistré");
    }

}
