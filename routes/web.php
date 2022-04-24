<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CharioController;
use App\Http\Controllers\TinelleController;
use App\Http\Controllers\CartonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//require 'custom.php';


Route::group([
    'prefix' => 'cartons',
    'middleware' => 'auth'
],
    function () {
        Route::get('', [CartonController::class, 'index']);
        Route::get('getDT', [CartonController::class, 'getDT']);
        Route::get('get/{id}', [CartonController::class, 'get']);
        Route::get('getTab/{id}/{tab}', [CartonController::class, 'getTab']);
        Route::get('add/{reception_poisson_id}', [CartonController::class, 'formAdd']);
        Route::post('add', [CartonController::class, 'add']);
        Route::post('edit', [CartonController::class, 'edit']);
        Route::get('delete/{id}', [CartonController::class, 'delete']);
        Route::get('stock_generale', [CartonController::class, 'stock_generale']);
        Route::get('get_stock_generaleDT', [CartonController::class, 'get_stock_generaleDT']);
    });
Route::group([
    'prefix' => 'tineles',
    'middleware' => 'auth'
],
    function () {
        Route::get('', [TinelleController::class, 'index']);
        Route::get('getDT/{selected?}', [TinelleController::class, 'getDT']);
        Route::get('get/{id}', [TinelleController::class, 'get']);
        Route::get('getTab/{id}/{tab}', [TinelleController::class, 'getTab']);
        Route::get('add', [TinelleController::class, 'formAdd']);
        Route::post('add', [TinelleController::class, 'add']);
        Route::post('edit', [TinelleController::class, 'edit']);
        Route::get('delete/{id}', [TinelleController::class, 'delete']);
        Route::get('dissociation_chario/{chario_id}/{tinelle_id}', [TinelleController::class, 'dissociation_chario_of_tinelle']);
        Route::post('add_charios_in_tinele', [TinelleController::class, 'add_charios_in_tinele']);
        Route::get('vider_tinelle/{tinele_id}', [TinelleController::class, 'vider_tinelle']);
        Route::get('get_fichier_info_tinele/{tinele_id}', [TinelleController::class, 'get_fichier_info_tinele']);
    });

Route::group([
    'prefix' => 'tests',
    'middleware' => 'auth'
],
    function () {
        Route::get('', [TestController::class, 'index']);
        Route::get('getDT/{test}/{selected?}', [TestController::class, 'getDT']);
        Route::get('get/{id}', [TestController::class, 'get']);
        Route::get('getTab/{id}/{tab}', [TestController::class, 'getTab']);
        Route::get('add', [TestController::class, 'formAdd']);
        Route::post('add', [TestController::class, 'add']);
        Route::post('edit', [TestController::class, 'edit']);
        Route::get('delete/{id}', [TestController::class, 'delete']);
    });


Route::group([
    'prefix' => 'clients',
    'middleware' => 'auth'],
    function () {
//        Route::get('', [ClientController::class, 'index']);
        Route::get('getDT/{selected?}', [ClientController::class, 'getDT']);
        Route::get('getDT', [ClientController::class, 'getDT']);
        Route::get('get/{id}', [ClientController::class, 'get']);
        Route::get('getTab/{id}/{tab}', [ClientController::class, 'getTab']);
        Route::get('add', [ClientController::class, 'formAdd']);
        Route::post('add', [ClientController::class, 'add']);
        Route::post('edit', [ClientController::class, 'edit']);
        Route::get('delete/{id}', [ClientController::class, 'delete']);
        Route::get('get_form_add_detaill/{id_client}', [ClientController::class, 'get_form_add_detaill']);
        Route::post('add_detaille_receptions', [ClientController::class, 'add_detaille_receptions']);
        Route::get('get_detaille_reception/{id_reception}', [ClientController::class, 'get_detaille_reception']);
        Route::post('edit_reception', [ClientController::class, 'edit_reception']);
        Route::get('exporter_reception/{reception_id}', [ClientController::class, 'get_reception_pdf']);
        Route::get('ajouter_traitement/{reception_id}', [ClientController::class, 'ajouter_traitement']);
        Route::get('delete_detaille/{poisson_id}/{reception_id}', [ClientController::class, 'delete_detaille_reception']);
        Route::post('edit_reception_traitement', [ClientController::class, 'edit_reception_traitement']);
        Route::get('get_pdf_traitement/{id_reception}', [ClientController::class, 'get_pdf_traitement']);
        Route::get('get_fiche_stock_client/{id_client}', [ClientController::class, 'get_fiche_stock_client']);
        Route::get('get_bon_sortie/{id_retire}', [ClientController::class, 'get_bon_sortie']);
        Route::post('retirer_carton', [ClientController::class, 'retirer_carton']);
    });

Route::group([
    'prefix' => 'charios',
    'middleware' => 'auth'
],
    function () {
        Route::get('', [CharioController::class, 'index']);
        Route::get('getDT/{tinele?}/{selected?}', [CharioController::class, 'getDT']);
        Route::get('getDT', [CharioController::class, 'getDT']);
        Route::get('get/{id}', [CharioController::class, 'get']);
        Route::get('getTab/{id}/{tab}', [CharioController::class, 'getTab']);
        Route::get('add', [CharioController::class, 'formAdd']);
        Route::post('add', [CharioController::class, 'add']);
        Route::post('edit', [CharioController::class, 'edit']);
        Route::get('delete/{id}', [CharioController::class, 'delete']);
        Route::get('form/get', [CharioController::class, 'get_form_affecte_poissons']);
        Route::get('get_receptions/{id_client}', [CharioController::class, 'get_receptions']);
        Route::get('get_form_affecte_poisson/{reception_id}', [CharioController::class, 'get_form_affecte_poisson']);
        Route::get('get_chario_disponible/get/{reception_poisson_id}', [CharioController::class, 'get_chario_disponible']);
        Route::get('get_nb_plat_disponible/{chario_ids}', [CharioController::class, 'get_nb_plat_disponible']);
        Route::post('add_poisson_to_chario', [CharioController::class, 'add_poisson_to_chario']);
        Route::get('get_info_chario_poisson/get/{rp}', [CharioController::class, 'get_info_chario_poisson']);
        Route::get('valider_reception_charios/{reception}', [CharioController::class, 'valider_reception_charios']);
        Route::get('get_fichier_info_charios', [CharioController::class, 'get_fichier_info_charios']);
    });

Auth::routes();

Route::get('/', [ClientController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});



