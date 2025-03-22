<?php

use App\Http\Controllers\CommandesController;
use App\Http\Controllers\DashbordsController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ProduitsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group([
    "middleware" =>  ["auth.admin"],
    // "as" => "admin."
  ], function(){
Route::get('/Accueil', [DashbordsController::class, 'TableauBord'])->name('Accueil');

Route::get('/Logout', [UserController::class, 'deconnexion'])->name('Logout');

Route::get('/active-user/{id}', [UserController::class, 'activeuser'])->name('active-user');
Route::get('/deactive-user/{id}', [UserController::class, 'deactiveuser'])->name('deactive-user');
Route::get('/Ventes', [VentesController::class, 'listeVentes'])->name('Ventes');
// Route::get('/recuperations', [VentesController::class, 'recuperations'])->name('recuperations');
Route::match(['get', 'post'], '/recuperations', [VentesController::class, 'recuperations'])->name('recuperations');
Route::get('/modificationVente/{id}', [VentesController::class, 'modificationvente'])->name('modificationVente');
Route::get('/rechercheArticle/{id}', [VentesController::class, 'recherchearticle'])->name('rechercheArticle');
Route::get('/Registre-vente', [VentesController::class, 'registrevente'])->name('Registre-vente');
Route::get('/Recherche-Registre', [VentesController::class, 'rechercheregistre'])->name('Recherche-Registre');
Route::get('/Registre-Commande', [CommandesController::class, 'registrecommande'])->name('Registre-Commande');


Route::resource('/Fiche-Ventes', VentesController::class);
Route::resource('/Fournisseur', FournisseursController::class);
Route::resource('/Produits', ProduitsController::class);
Route::resource('/Commandes', CommandesController::class);
Route::resource('/Users', UserController::class);
});
Route::post('Login-Submit', [UserController::class, 'postuserlogin'])->name('Login-Submit');
Route::get('/', [UserController::class, 'connexion'])->name('login');