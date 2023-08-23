<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//use app\http\Controllers\API\UsuariosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('usuarios')->group(function(){
    Route::get('/', 'app\Http\Controllers\API\UsuariosController@get');
    Route::post('/','app\Http\Controllers\API\UsuariosController@create');
    Route::get('/{id}','app\Http\Controllers\API\UsuariosController@getById');
    Route::post('/login','app\Http\Controllers\API\UsuariosController@login');
    Route::put('/{id}','app\Http\Controllers\API\UsuariosController@update');
    Route::delete('/{id}','app\Http\Controllers\API\UsuariosController@delete');
});
