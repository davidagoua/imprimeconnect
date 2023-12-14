@extends('base')
@php
    $page_title = "Clients"   ;
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
                        <th>CLIENT</th>
                        <th>CONTACT</th>
                        <th>MONTANT</th>
                        <th>COMMANDES</th>
                        <th>ACTIONS</th>
                    </tr>
                    @foreach($clients as $contact => $commandes)
                        <tr>
                            <td>{{ $commandes->first()->client_nom }}</td>
                            <td>{{ $contact }}</td>
                            <td>{{ $commandes->sum(fn($commande)=>$commande->montant) }} FCFA</td>
                            <td>{{ $commandes->count()  }}</td>

                            <td>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
