<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaiementsController;
use App\Http\Controllers\RemiseChequesController;

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

Route::get('/',  [HomeController::class, 'index'])->name('dashboard');
Route::get('/paiements/current',  [PaiementsController::class, 'index'])->name('current_recap');
Route::get('/paiements',  [PaiementsController::class, 'recap'])->name('recap');
Route::get('/paiements/add',  [PaiementsController::class, 'add_form'])->name('add_consultation_form');
Route::post('/paiements/add',  [PaiementsController::class, 'add'])->name('add_consultation');
Route::get('/remise_cheques',  [RemiseChequesController::class, 'index'])->name('remise_cheques');
Route::get('/remise_cheques/add',  [RemiseChequesController::class, 'add_form'])->name('remise_cheques_add_form');
Route::post('/remise_cheques/add',  [RemiseChequesController::class, 'add'])->name('add_remise_cheques');

