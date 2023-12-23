<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::any('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');


Route::middleware(['auth'])->group(function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'dispatch'])->name('home');
   Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


   Route::resource('users', \App\Http\Controllers\UserController::class);
   Route::get('users/{user}/delete', [\App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

   Route::resource('commandes', \App\Http\Controllers\CommandeController::class);
   Route::get('commandes/{commande}/delete', [\App\Http\Controllers\CommandeController::class, 'delete'])->name('commandes.delete');
   Route::get('commandes/{commande}/pdf', [\App\Http\Controllers\CommandeController::class, 'pdf'])->name('commandes.pdf');
   Route::get('/commandes-design/', [\App\Http\Controllers\LigneController::class, 'index_design'])->name('commandes.design');
   Route::get('/commandes-finition/', [\App\Http\Controllers\LigneController::class, 'index_finition'])->name('commandes.finition');
   Route::get('/clients', [\App\Http\Controllers\CommandeController::class, 'clients'])->name('clients.index');

   Route::get('/download/{file}', function(Request $request, $file){
       return response()->file(storage_path('app/'.$file));
   })->name('download');

   Route::get('/lignes/{ligne}/delete',[\App\Http\Controllers\LigneController::class, 'delete'])->name('lignes.delete');
   Route::post('/lignes/{ligne}/upload',[\App\Http\Controllers\LigneController::class, 'store_design'])->name('lignes.upload');
   Route::get('/lignes/{ligne}/edit',[\App\Http\Controllers\LigneController::class, 'edit'])->name('lignes.edit');
   Route::get('/lignes/{ligne}/revert',[\App\Http\Controllers\LigneController::class, 'revert'])->name('lignes.revert');
   Route::get('/lignes/{ligne}/terminer',[\App\Http\Controllers\LigneController::class, 'terminer'])->name('lignes.terminer');

   Route::get('/avances/{commande}/form', [\App\Http\Controllers\AvanceController::class, 'create'])->name('avance.create');
   Route::post('/avances/{commande}', [\App\Http\Controllers\AvanceController::class, 'store'])->name('avance.store');
   Route::get('/avances/{avance}/delete', [\App\Http\Controllers\AvanceController::class, 'delete'])->name('avance.delete');
});
