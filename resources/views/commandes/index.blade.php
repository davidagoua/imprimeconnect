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
                        <a href="{{ route('commandes.create') }}" class="btn btn-primary">Ajouter</a>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>CLIENT</th>
                        <th>CONTACT</th>
                        <th>MONTANT</th>
                        <th>INFOGRAPHISTE</th>
                        <th>FICHIERS</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                    @foreach($commandes as $commande)
                        <tr class="@if($commande->deleted_at) text-danger @endif">
                            <td>#{{ $commande->pk }}</td>
                            <td>{{ $commande->client_nom }}</td>
                            <td>{{ $commande->contact }}</td>
                            <td>{{ $commande->montant }}</td>
                            <td>{{ $commande->infographiste?->name ?? 'nom defini' }}</td>
                            <td>{{ $commande->lignes->count()  }}</td>
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
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
