@extends('base')

@php
$page_title='Ajouter un utilisateur'
@endphp
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card ">
            <div class="card-body">
                @if($user->exists)
                <form action="{{ route('users.update', ['user'=>$user]) }}" method="post"
                @else
                <form action="{{ route('users.store') }}" method="post">
                @endif

                    @csrf
                    <div class="mb-3">
                        <label for="">Nom & Prénoms</label>
                        <input required type="text" value="{{ $user->name ?? '' }}" class="form-control" name="name">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input required type="email" value="{{ $user->email ?? '' }}" class="form-control" name="email">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Contact</label>
                        <input required type="phone" value="{{ $user->contact ?? '' }}" class="form-control" name="contact">
                        @error('contact')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Mot de passe</label>
                        <input required type="password" class="form-control" name="password">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Rôle</label>
                        <select name="roles" multiple id="" class="form-control" style="height: 90px">
                            @foreach($roles as $role)
                                <option @if($user->hasRole($role->name)) selected @endif value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="text-right">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
