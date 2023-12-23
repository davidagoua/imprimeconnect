@extends('base')
@php
    $page_title = "Commandes"   ;
 @endphp
@section('content')


    <div>
        <div class="card">
            <div class="card-body">
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
                        <tr class="@if($commande->deleted_at) text-danger @endif">
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
                                <a class="btn btn-sm btn-secondary" href="{{ route('commandes.edit', ['commande'=>$commande]) }}">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('commandes.delete', ['commande'=>$commande]) }}">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <a class="btn btn-sm btn-info" href="{{ route('commandes.pdf', ['commande'=>$commande]) }}">
                                    <span class="fa fa-download"></span>
                                </a>
                                <a class="btn btn-sm btn-success" data-toggle="collapse" href="#avance-modal-{{$commande->id}}">
                                    <span class="fa fa-usd"></span>
                                </a>
                            </td>
                        </tr>
                        <div class="collapse" id="avance-modal-{{$commande->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
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
                        </div>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
