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

// accueil

Route::name('home')->any('/', function(){
    return view('pages/accueil');
});

// fiche projet

Route::name('fiche-projet')->get('/fiche-projet', function () {
    return view('pages/fiche_projet');
});

// projets

Route::name('blog-environement')->get('/projets/blog-environement', function () {
    return view('projets/Blog-environement/index');
});

// back office

Route::name('connexion-back-office')->any('/connexion-back-office', function () {
    return view('pages/back_office_connexion');
});

Route::name('back-office')->get('/back-office', function () {
    return view('pages/back_office');
});

Route::name('modifier-projet')->any('/modifier-projet', function () {
    return view('pages/modifier_projet');
});

Route::name('supprimer-projet')->any('/supprimer-projet', function () {
    return view('pages/supprimer_projet');
});