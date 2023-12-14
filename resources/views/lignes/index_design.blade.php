@extends('base')
@php
    $page_title = "Commandes en design"   ;
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
                            <td><span class="badge badge-secondary">{{ '.'.str($ligne->file)->split('/[\s.]+/')->last() }}</span></td>
                            <td>{{ $ligne->commande->format }}</td>

                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('download', ['file'=>$ligne->file]) }}">
                                    <span class="fa fa-download"></span>
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('lignes.delete', ['ligne'=>$ligne]) }}">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('lignes.edit', ['ligne'=>$ligne]) }}">
                                    <span class="fa fa-upload"></span>
                                    <span class="">Upload</span>
                                </a>

                            </td>

                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
