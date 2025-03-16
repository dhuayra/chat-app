<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/contacts', [MessageController::class, 'index'])->name('contacts');
    Route::get('/contacts/{contactId}', [MessageController::class, 'showMessages'])->name('chat.show');
    Route::post('/contacts/{contactId}/send', [MessageController::class, 'sendMessage'])->name('chat.send');

    Route::get('/settings', function(){return view('settings.show');})->name('settings');
});
