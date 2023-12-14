@extends('base')

@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div></div>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter</a>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>CONTACT</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>ACTIONS</th>
                </tr>
                @foreach($objects as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->contact }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles()->first()->name }}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="{{ route('users.edit', ['user'=>$user]) }}">
                                <span class="fa fa-edit"></span>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('users.delete', ['user'=>$user]) }}">
                                <span class="fa fa-trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
