<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('tasks', 'App\Domain\Tasks\TaskController@getAll')->name('tasks.getAll');
Route::get('tasks/mark/{id}', 'App\Domain\Tasks\TaskController@mark')->name('tasks.mark');
Route::get('tasks/{id}', 'App\Domain\Tasks\TaskController@show')->name('tasks.show');
Route::post('tasks', 'App\Domain\Tasks\TaskController@store')->name('tasks.store');
Route::put('tasks/{id}', 'App\Domain\Tasks\TaskController@update')->name('tasks.update');
Route::delete('tasks/{id}', 'App\Domain\Tasks\TaskController@delete')->name('tasks.delete');
