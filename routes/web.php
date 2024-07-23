<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Models\Contact;

Route::get('/', function () {
    if (Auth::check()) {
        return app(ContactController::class)->index();
    } else {
        return view('login');
    }
});
Route::post('/login_attempt', [UserController::class, 'login']);
Route::post('/register_user', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/delete_account', [UserController::class, 'delete']);


Auth::routes();

Route::post('/add_contact', [ContactController::class, 'add']);
Route::post('/edit_contact/{id}', [ContactController::class, 'edit']);
Route::post('/delete_contact/{id}', [ContactController::class, 'delete']);
