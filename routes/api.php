<?php

use Illuminate\Http\Request;

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

Route::post('/checkSolvableAndSave', 'PuzzleController@checkSolvableAndSave');
Route::post('/checkSolved', 'PuzzleController@checkSolved');
Route::get('/getPuzzles', 'PuzzleController@getPuzzles');
Route::get('/getPuzzle/{id}', 'PuzzleController@getPuzzle');
Route::post('/solvePuzzle', 'PuzzleController@solvePuzzle');
