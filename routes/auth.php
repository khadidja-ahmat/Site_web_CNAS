<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController as AdminAuth;
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

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});


// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('home', [StudentController::class, 'home'])->name('home');
Route::get('students', [StudentController::class, 'students'])->name('list.students');
Route::get('show_student', [StudentController::class, 'show'])->name('show.student');

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


Route::prefix('/admin')->name('admin.')->group(function (){


    Route::get('/login', [AdminAuth::class, 'create'])->middleware('guest:admin')->name('login');
    Route::post('/login', [AdminAuth::class, 'store'])->middleware('guest:admin');

    Route::middleware('admin')->group(function (){

        Route::get('/logout', [AdminAuth::class, 'destroy'])->name('logout');
        Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
        Route::get('/admin-dash', [AdminController::class, 'index'])->name('dash');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');

        Route::get('/profile/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::patch('/profile/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('profile/{id}', [AdminController::class, 'destroy'])->name('destroy');

        Route::get('create_student', [StudentController::class, 'create'])->name('create.student');
        Route::post('store_student', [StudentController::class, 'store'])->name('store.student');
        Route::get('edit_student/{id}', [StudentController::class, 'edit'])->name('edit.student');
        Route::put('update_student/{id}', [StudentController::class, 'update'])->name('update.student');
        Route::delete('delete_student/{id}', [StudentController::class, 'destroy'])->name('delete.student');
        Route::get('show_student', [StudentController::class, 'show'])->name('show.student');


        Route::resource('adresses', AdresseController::class);
        Route::resource('abouts', AboutController::class);

        
       
        
        
        
        Route::resource('institutions', InstitutionController::class);
        Route::resource('galeries', GalerieController::class);
        Route::resource('actualites', ActualiteController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('realisations', RealisationController::class);
        Route::resource('organigrammes', OrganigrammeController::class);
        Route::resource('presidents', PresidentController::class);
        Route::resource('presentations', PresentationController::class);
        Route::resource('directions', DirectionController::class);


        Route::get('galeries', [GalerieController::class, 'home'])->name('galeries.home');
        Route::get('realisations', [RealisationController::class, 'home'])->name('realisations.home');
        Route::get('institutions', [InstitutionController::class, 'home'])->name('institutions.home');
        Route::get('organigrammes', [OrganigrammeController::class, 'home'])->name('organigrammes.home');
        Route::get('presidents', [PresidentController::class, 'home'])->name('presidents.home');
        Route::get('presentations', [PresentationController::class, 'home'])->name('presentations.home');
        Route::get('abouts', [AboutController::class, 'home'])->name('abouts.home');
        Route::get('actualites', [ActualiteController::class, 'home'])->name('actualites.home');
        Route::get('adresses', [AdresseController::class, 'home'])->name('adresses.home');
        Route::get('contacts', [ContactController::class, 'home'])->name('contacts.home');

    });
});
