<?php

use App\Http\Controllers\AutreController;
use App\Http\Controllers\EcoleController;
use App\Livewire\AllProduct;
use App\Livewire\CommuneCreate;
use App\Livewire\CommuneEdit;
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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['prefix' => 'plateforme', 'middleware' => 'auth'],function(){
    Route::get('/allProduct', AllProduct::class)->name('plateforme.allProduct');
    Route::get('/ecoles', [EcoleController::class, 'ecole'])->name('plateforme.ecoles');
});

Route::group(['prefix' => 'autres', 'middleware' => 'auth'],function(){
    Route::get('/communes', [AutreController::class, 'commune'])->name('autres.communes');
    Route::get('/communes/create', CommuneCreate::class)->name('autres.communes.create');
    Route::get('/communes/{commune}/edit', CommuneEdit::class)->name('autres.communes.edit');
});

require __DIR__.'/auth.php';
