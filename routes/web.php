<?php


use App\Models\Activity;
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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/projects', [App\Http\Controllers\HomeController::class, 'index'])->name('projects');

    Route::get( '/projects',[App\Http\Controllers\ProjectsController::class, 'index']);
    Route::get( '/projects/create',[App\Http\Controllers\ProjectsController::class, 'create']);
    Route::get( '/projects/{project}',[App\Http\Controllers\ProjectsController::class, 'show']);
    Route::get( '/projects/{project}/edit',[App\Http\Controllers\ProjectsController::class, 'edit']);
    Route::patch('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'update']);
    Route::post('/projects', [App\Http\Controllers\ProjectsController::class, 'store']);

    Route::post('projects/{project}/invitations', 'App\Http\Controllers\ProjectInvitationsController@store');

    Route::delete('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'destroy']);

    Route::post('/projects/{project}/tasks', [App\Http\Controllers\ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [App\Http\Controllers\ProjectTasksController::class, 'update']);


    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});





