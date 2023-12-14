<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()->whereNot('name','admin')->get();

        return view('users.index', [
            'objects'=>$users,
            'page_title'=>'Utilisateurs',
        ]);
    }

    public function create(Request $request)
    {
        return $this->edit($request, new User());
    }

    public function edit(Request $request, User $user)
    {
        $roles = Role::query()->whereNot('name','admin')->get();
        return view('users.form', [
            'roles'=>$roles,
            'user'=>$user
        ]);
    }

    public function store(Request $request)
    {
        return $this->update($request, new User());
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'required',
            'password'=>'required',
            'contact'=>'required',
            'email'=>'required',
        ]);
        $user->fill($data);
        if(! $user->exists){
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        $user->syncRoles($request->input('roles'));

        return back()->with('success', "Utilisateur enregistré");
    }

    public function delete(User $user)
    {
        $user->delete();
        return back()->with('success', "Utilisateur supprimé");
    }
}
