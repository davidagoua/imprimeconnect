<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Ligne;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        if(! auth()->user()->hasRole('admin')){
            $commandes = Commande::query()->whereNull('deleted_at')->get();
        }   else{
            $commandes = Commande::withoutGlobalScope('actif')->get();
        }
        return view('commandes.index', [
            'commandes'=> $commandes
        ]);
    }

    public function create(Request $request)
    {
        return $this->edit($request, new Commande());
    }

    public function edit(Request $request, Commande $commande)
    {
        $conseilles = User::role('conseiller')->select('name','id')->get();
        $infos = User::role('designer')->select('name','id')->get();

        return view('commandes.edit', [
           'commande'=>$commande,
            'page_title'=> $commande->exists ? 'Modifier une commande' : 'Ajouter une commande',
            'conseilles' => $conseilles,
            'designers' => $infos,
        ]);
    }

    public function store(Request $request)
    {
        return $this->update($request, new Commande());
    }

    public function update(Request $request, Commande $commande)
    {
        //dd($request->input(), $request->file('fichier-1'));
        $validation = Validator::make($request->all(),[
            'client_nom'=>'required',
            'contact'=>'numeric|required',
            'deadline'=>'required|date',
            'lieu_livraison'=>'required',
            'format'=>'required',
            'conseiller_id'=>'numeric',
            'infographiste_id'=>'numeric',
            'quantites'=>'array',
            'designations'=>'array',
            'dimensions'=>'array',
            'nombres'=>'array',
            'pus'=>'array',
            'exists'=>'array'
        ]);

        if($validation->fails()){
            return back()->with('error', $validation->errors());
        }

        $data = $validation->validated();
        $commande->status = 'design';
        $commande->fill($data)->save();

        $commande->refresh();

        for ($i = 0; $i < count($data['designations']); $i++) {
            $filepath = $request->file('fichier-'.$i+1)->storePublicly();
            if(! (bool) $data['exists'][$i]){
                $ligne = new Ligne([
                    'designation'=>$data['designations'][$i],
                    'quantite'=>$data['quantites'][$i],
                    'dimension'=>$data['dimensions'][$i],
                    'pu'=>$data['pus'][$i],
                    'nombre'=>$data['nombres'][$i],
                    'file'=>$filepath,
                    'commande_id'=>$commande->id,
                    'status'=>'design'
                ]);
                $ligne->save();
            }else{
                Ligne::query()->firstWhere('id', $data['exists'][$i])->update([
                    'designation'=>$data['designations'][$i],
                    'quantite'=>$data['quantites'][$i],
                    'dimension'=>$data['dimensions'][$i],
                    'pu'=>$data['pus'][$i],
                    'nombre'=>$data['nombres'][$i],
                    'file'=>$filepath,
                    'commande_id'=>$commande->id
                ]);
            }
        }


        return redirect()->route('commandes.index')->with('success', 'Commande enrégistrée');
    }

    public function delete(Request $request, Commande $commande)
    {
        $commande->lignes()->delete();
        $commande->update(['deleted_at'=>now()]);
        return back()->with('success', "Commande supprimée");
    }

    public function pdf(Request $request, Commande $commande)
    {
        
        $pdf = Pdf::loadView('pdfs.commande', [
            'commande'=>$commande
        ]);
        return $pdf->download('commande_'.$commande->pk);
        /*
        return view('pdfs.commande', [
            'commande'=>$commande
        ]);
        */
    }

    public function clients(Request $request)
    {
        $clients = Commande::query()->get()
            ->groupBy('contact','client_nom');
        return view('commandes.clients', [
            'clients'=>$clients
        ]);
    }
}
