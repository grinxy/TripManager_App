<?php

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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======


Route::resource('/viajes', ViajeController::class);
Route::get('viajes/{id}/show', [ViajeController::class, 'show'])->name('viajes.show');  //metodo adicional al CRUD
Route::put('/viajes/{id}', [ViajeController::class, 'update'])->name('viajes.update');  //para metodos PUT - editar entrada existente, no funciona resource

Route::resource('/reservas', ReservaController::class);
>>>>>>> Stashed changes
