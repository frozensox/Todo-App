<?php
use App\Http\Controllers\TaskController;

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'TaskController@index');
    Route::post('/', 'TaskController@store');
    Route::delete('/', 'TaskController@delete');
    // Route::put('/', [TaskController::class, 'change']);
    // Route::patch('/', [TaskController::class, 'sort']);
    Route::get('/edit/{task}', [TaskController::class, 'edit']);
    Route::post('/edit/{task}', [TaskController::class, 'update']);
});
Route::get('/home', 'HomeController@index')->name('home');
