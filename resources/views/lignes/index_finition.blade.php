@extends('base')
@php
    $page_title = "Commandes en finition"   ;
@endphp
@section('content')


    <div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div></div>
                </div>
                <table class="table">
                    <tr>
                        <th>COMMANDE</th>
                        <th>DESIGNATION</th>
                        <th>CLIENT</th>
                        <th>DIMENSION</th>
                        <th>TYPE</th>
                        <th>FORMAT</th>

                        <th>ACTIONS</th>
                    </tr>
                    @foreach($lignes as $ligne)
                        <tr class="@if($ligne->deleted_at) text-danger @endif">
                            <td><a href="">#{{ $ligne->commande->pk }}</a></td>
                            <td>
                                <span >{{ $ligne->designation }}</span>
                            </td>
                            <td>{{ $ligne->commande->client_nom }}</td>
                            <td>{{ $ligne->dimension }}</td>
                            <td>
                                <a href="{{ route('download', ['file'=>$ligne->file]) }}">
                                    <span class="badge badge-secondary">{{ $ligne->designation }}{{ '.'.str($ligne->file)->split('/[\s.]+/')->last() }}</span>
                                </a>
                            </td>
                            <td>{{ $ligne->commande->format }}</td>

                            <td>
                                @if($ligne->status === 'finition')
                                <a title="télécharger" class="btn btn-sm btn-info" href="{{ route('download', ['file'=>$ligne->file]) }}">
                                    <span class="fa fa-download"></span>
                                </a>
                                <a title="supprimer" class="btn btn-sm btn-danger" href="{{ route('lignes.delete', ['ligne'=>$ligne]) }}">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <a title="renvoyer au designer" class="btn btn-sm btn-warning" href="{{ route('lignes.revert', ['ligne'=>$ligne]) }}">
                                    <span class="fa fa-times"></span>
                                </a>
                                <a title="Terminer" class="btn btn-sm btn-success" href="{{ route('lignes.terminer', ['ligne'=>$ligne]) }}">
                                    <span class="fa fa-check"></span>
                                </a>
                                @else
                                    <span class="badge bg-success">Traitée</span>
                                @endif
                            </td>

                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
