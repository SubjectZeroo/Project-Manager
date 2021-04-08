<?php

use App\Models\Project;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function() {

    Route::get( '/projects',[App\Http\Controllers\ProjectsController::class, 'index']);
    Route::get( '/projects/{project}',[App\Http\Controllers\ProjectsController::class, 'show']);
    Route::post('/projects', [App\Http\Controllers\ProjectsController::class, 'store']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
