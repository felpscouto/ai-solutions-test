<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessDocumentsController;

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

Route::get('/', function () {
    return view('documents/index');
});

Route::get('/process', function () {
    return view('documents/process');
});

Route::post('/upload-json-file', [ProcessDocumentsController::class, 'uploadJsonFile']);