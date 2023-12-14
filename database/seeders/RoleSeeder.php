<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'reception']);
        Role::create(['name'=>'finition']);
        Role::create(['name'=>'conseiller']);
        Role::create(['name'=>'designer']);

        $user = User::create([
           'name'=>'admin',
           'email'=>'admin@mail.com',
           'password'=>Hash::make('password')
        ]);
        $user->assignRole('admin');
    }
}
