@extends('base')

@section('content')
<div class="row">
    <div class="col-12 ">
        <div class="card ">
            <div class="card-body">
                @if($commande->exists)
                    <form action="{{ route('commandes.update', ['commande'=>$commande]) }}" enctype="multipart/form-data" method="post" class="row"/>
                    @method('PUT')
                @else
                    <form action="{{ route('commandes.store') }}" class="row" method="post" enctype="multipart/form-data">
                        @endif

                        @csrf
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Nom & Prénoms du client</label>
                            <input required type="text" value="{{ $commande->client_nom ?? '' }}" class="form-control" name="client_nom">
                            @error('client_nom')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Contact</label>
                            <input pattern="[0-9.]+" required type="text" value="{{ $commande->contact ?? '' }}" class="form-control" name="contact">
                            @error('contact')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <hr class="col-12">
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Delai de livraison</label>
                            <input required type="date" value="{{ $commande->deadline ?? '' }}" class="form-control" name="deadline">
                            @error('deadline')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Lieu de livraison</label>
                            <input value="{{ $commande->lieu_livraison ?? '' }}" required type="text" class="form-control" name="lieu_livraison">
                            @error('lieu_livraison')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Format</label>
                            <select name="format"  id="" class="form-control">
                                @foreach(['Grand Format'=>'Grand Format', 'Petit Format'=>'Petit Format','Signalitique'=>'Signalitique','Autre'=>'Autres','Gadget'=>'Gadget','Textile'=>'Textile'] as $format => $label)
                                <option value="{{ $format }}" @selected($commande->format === $format)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-12">
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Infographiste</label>
                            <select name="infographiste_id"  id="" class="form-control">
                                @foreach($designers as $designer)
                                    <option @if($commande->infographiste_id == $designer->id) selected @endif value="{{ $designer->id }}">{{ ucfirst($designer->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Mode de paiement</label>
                            <select name="mode_paiement"  id="" class="form-control">
                                @foreach(['Espèce','OM','Momo','Wave','Chèque'] as $format)
                                    <option value="{{ $format }}" @selected($commande->format === $format)>{{ $format }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4 col-12">
                            <label for="">Canal</label>
                            <select name="canal"  id="" class="form-control">
                                @foreach(['Téléphone','Facebook','Whatsapp','SMS','Mail'] as $format)
                                    <option value="{{ $format }}" @selected($commande->canal === $format)>{{ $format }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 border rounded p-3 col-12 sup-repeater">
                            <p class="text-right">
                                <a href="#"  class="btn-link btn" id="addEntry">+ Ajouter</a>
                            </p>
                        </div>
                        <p class="text-right col-12">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </p>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let entries = [{}]


    let prototype = $('.for-repeater')
    let parent = $('.sup-repeater')
    let toDelete = []

    let addEntry = (e)=>{
        e.preventDefault()
        entries.push({})
        updateEntries()
    }

    let removeEntry = (index)=>{
        toDelete.push(index - 1)
        $('#entry_'+index).remove()
    }

    $('#addEntry').on('click', addEntry)


    function updateEntries(data={}){
        let i = entries.length
        let proto = $('div').innerHTML = `
                <div class="row mb-3 for-repeater" id="entry_${i}">
                    <input type="hidden" name="exists[]" value="${ data.id !== undefined ? data.id : 0}">
                    <div class="col-12 col-md-2">
                        <label for="">Quantité</label>
                        <input value="${data.quantite ?? 1}" class="form-control" type="number" required name="quantites[]">

                    </div>
                    <div class="col-12 col-md-3">
                        <label for="">Designation</label>
                        <input value="${data.designation ?? ''}" class="form-control" type="text" required name="designations[]">
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="">Dimension</label>
                        <input value="${data.dimension ?? ''}" class="form-control" type="text" required name="dimensions[]">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="">Fichier</label>
                        <input class="form-control"  type="file" required name="fichier-${i}">
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="">Prix Unitaire</label>
                        <a href="#" onclick="event.preventDefault(); removeEntry(${i})" class="float-right text-danger"><i class="fa fa-times"></i></a>
                        <input value="${data.pu ?? 0}" class="form-control" type="text" required name="pus[]">
                    </div>
                    <div class="col-12 mb-2">
                        <label for="">Nb</label>
                        <textarea name="nbs[]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <hr/>
            `
        parent.append(proto)
    }

    @if($commande->exists)
        @foreach($commande->lignes as $ligne)
        updateEntries(@json($ligne))
        @endforeach
    @else
    updateEntries()
    @endif

</script>
@endpush
