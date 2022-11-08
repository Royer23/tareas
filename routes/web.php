<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';



//Route::get('/works', [WorkController::class, 'index'])->middleware('auth')->name('works.index');
//Route::get('works',[WorkController::class, 'store'])->middleware('auth');
Route::resource('works', WorkController::class)->middleware(['auth', 'verified']);