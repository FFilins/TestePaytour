<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\EmailController;

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

// Route::get('/', function () {
//     return view('layout.layout');
// });

Route::get('/' , [CurriculoController::class , 'show'])->name('curriculo.show');
Route::post('/' , [CurriculoController::class , 'add'])->name('curriculo.add');

Route::get('/enviar-email' , [Emailcontroller::class, 'enviarEmail'])->name('email.enviar');
