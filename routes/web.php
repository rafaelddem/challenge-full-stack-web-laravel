<?php

use App\Http\Controllers\OutroController;
use App\Http\Controllers\StudentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/token', function () {
//     return csrf_token(); 
// });

Route::prefix('/student')->group(function () {
    Route::post('/new', [StudentController::class, 'store']);
});