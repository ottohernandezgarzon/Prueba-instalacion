<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
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

Route::get( '/', function ()
{
    return view( 'welcome' );
} );
Route::get( 'tareas', function ()
{
    return view( 'ta' );
} );

/* ------------------------------- Route Todos ------------------------------ */

Route::get( 'tareas', [ TodoController::class, 'index' ] )->name( 'todos' );
Route::post( 'tareas', [ TodoController::class, 'store' ] )->name( 'todos-store' );
Route::get( 'tareas/{id}', [ TodoController::class, 'show' ] )->name( 'todos-show' );
Route::delete( 'tareas/{id}', [ TodoController::class, 'destroy' ] )->name( 'destroy' );
Route::patch( 'tareas/{id}', [ TodoController::class, 'update' ] )->name( 'todos-update' );


/* ------------------------- Route Resource Category ------------------------ */

Route::resource( 'categories', CategoryController::class);
