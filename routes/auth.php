<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganigrammeController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\RealisationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\DirectionController;

/*
|--------------------------------------------------------------------------
| Site visiteur
|--------------------------------------------------------------------------
*/

Route::get('/', [WebController::class, 'index'])->name('site.index');

Route::get('abouts', [AboutController::class, 'index'])->name('abouts.index');
Route::get('actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('adresses', [AdresseController::class, 'index'])->name('adresses.index');
Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('directions', [DirectionController::class, 'index'])->name('directions.index');
Route::get('galeries', [GalerieController::class, 'index'])->name('galeries.index');
Route::get('institutions', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('organigrammes', [OrganigrammeController::class, 'index'])->name('organigrammes.index');
Route::get('presentations', [PresentationController::class, 'index'])->name('presentations.index');
Route::get('presidents', [PresidentController::class, 'index'])->name('presidents.index');
Route::get('realisations', [RealisationController::class, 'index'])->name('realisations.index');

// Envoi du formulaire de contact par les visiteurs (limité à 10 envois par minute).
// Le nom 'admin.contacts.store' est conservé tel quel : c'est celui qu'utilise le
// formulaire (resources/views/contacts/contact.blade.php).
Route::post('contacts', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('admin.contacts.store');

/*
|--------------------------------------------------------------------------
| Administration : ChariPHP (dossier public/gestion)
|--------------------------------------------------------------------------
|
| Il n'y a plus qu'une seule administration : ChariPHP.
| /login (et les anciennes adresses /admin, /dashboard) mènent à sa connexion.
| Le compte utilisé est celui de la table `admins`.
|
*/

Route::redirect('/login', '/gestion/login.php')->name('login');
Route::redirect('/admin', '/gestion/login.php');
Route::redirect('/admin/login', '/gestion/login.php');
Route::redirect('/dashboard', '/gestion/login.php');
