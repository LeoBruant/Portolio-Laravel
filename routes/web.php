<?php

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

Route::name('home')->get('/', function(){
    return view('pages/index');
});

Route::name('fiche-projet')->get('/fiche-projet', function () {
    return view('pages/fiche_projet');
});

Route::name('connexion-back-office')->get('/connexion-back-office', function () {
    return view('pages/back_office_connexion');
});