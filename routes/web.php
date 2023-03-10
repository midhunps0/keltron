<?php

use App\Http\Controllers\DefaultController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DefaultController::class, 'details'])->name('details.create');
Route::post('/search', [DefaultController::class, 'search'])->name('search');
Route::post('/details', [DefaultController::class, 'details'])->name('details.post');
