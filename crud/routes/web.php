<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/users', [UserController::class, 'index'])
    ->name('users.index'); // маршрут для получения всех пользователей

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show'); // маршрут для получения одного пользователя по его ID

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store'); // маршрут для записи нового пользователя в базу данных

Route::get('/users/{id}/pdf', [UserController::class, 'exportPdf'])
    ->name('users.exportPdf'); // маршрут для получения данных о пользователе в виде PDF-файла

