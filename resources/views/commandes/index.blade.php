@extends('base')
@php
    $page_title = "Commandes"   ;
 @endphp
@section('content')


    <div>
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <form action="" >
                        <div  class="row align-items-baseline b-2 ">
                            <div class="row col-md-10">
                                <div class="col-12 col-md-3 ">
                                    <input placeholder="N° Ticket" type="text" name="id" class="form-control">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <input placeholder="Nom du client" type="text" name="client_nom" class="form-control">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <input placeholder="Contact du client" type="text" name="contact" class="form-control">
                                </div>
                                <div class="col-12 col-md-3 ">
                                    <select name=filter class="form-control" id="">
                                        <option value="state">Terminé</option>
                                        <option value="montant">Soldé</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right col-md-2 h-full">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-search"></span>&nbsp;
                                    <span>Rechercher</span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="d-flex justify-content-between">
                    <div></div>

                    <div>
                        @hasanyrole('admin|conseiller')
                        <a href="{{ route('commandes.create') }}" class="btn btn-primary">Ajouter</a>
                        @endhasanyrole
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>DATE</th>
                        <th>CLIENT</th>
                        <th>CONTACT</th>
                        <th>PAIEMENT</th>
                        <th>INFOGRAPHISTE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                    @foreach($commandes as $commande)
                        <tr class="@if($commande->deleted_at) text-danger @endif
                            @if($commande->avances()->sum('montant') == $commande->montant) text-dark font-weight-bold @endif
                        ">
                            <td>#{{ $commande->pk }}</td>
                            <td>{{ Date::create($commande->created_at)->format('d/M/Y') }}</td>
                            <td>{{ $commande->client_nom }}</td>
                            <td>{{ $commande->contact }}</td>
                            <td>{{ $commande->avances()->sum('montant') }} /{{ $commande->montant }}</td>
                            <td>{{ $commande->infographiste?->name ?? 'nom defini' }}</td>
                            <td>
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" data-width="{{ $commande->percent  }}%" aria-valuenow="{{ $commande->percent  }}" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </td>
                            @hasrole('admin')
                            @endhasrole
                            <td>
                                <a title="Modifier la commande" class="btn btn-sm btn-secondary" href="{{ route('commandes.edit', ['commande'=>$commande]) }}">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <a title="Telecharger le reçu" class="btn btn-sm btn-info" href="{{ route('commandes.pdf', ['commande'=>$commande]) }}">
                                    <span class="fa fa-download"></span>
                                </a>
                                <a class="btn btn-sm btn-success" title="Avancer" onclick="document.querySelector('#avance-modal-{{$commande->id}}').show()" data-toggle="collapse" href="">
                                    <span class="fa fa-money-check"></span>
                                </a>
                            </td>
                        </tr>
                        <dialog id="avance-modal-{{$commande->id}}" class="shadow border-none">
                            <div class="">
                                <button class="float-right btn-link" onclick="document.querySelector('#avance-modal-{{$commande->id}}').close()">
                                    <span class="fa fa-times" ></span>
                                </button>
                                <div class="">
                                    <div class="modal-header font-weight-bold">Ajouter une avance</div>
                                    <div class="modal-body">
                                        <form action="{{ route('avance.store', ['commande'=>$commande]) }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="">Montant</label>
                                                <input class="form-control" type="text" pattern="[0-9.]+" name="montant">
                                            </div>
                                            <p class="text-right">
                                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </dialog>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
