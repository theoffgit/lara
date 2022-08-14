<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\CreateNewsController;
use App\Http\Controllers\News\ReadNewsController;
use App\Http\Controllers\News\DeleteNewsController;
use App\Http\Controllers\News\UpdateNewsController;
use App\Http\Controllers\News\ErrorNewsController;


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
})->middleware(['auth'])->name('dashboard');


Route::get('/news/create', [CreateNewsController::class, 'create'])
               ->middleware(['auth'])
               ->name('news.createform');
Route::post('/news/create', [CreateNewsController::class, 'store'])
               ->middleware(['auth'])
               ->name('news.create');

Route::get('/news/read/{id}', [ReadNewsController::class, 'read'])
               ->middleware(['auth'])
               ->name('news.read');

Route::get('/news/delete/{id}', [DeleteNewsController::class, 'create'])
               ->middleware(['auth']);
Route::post('/news/delete', [DeleteNewsController::class, 'delete'])
               ->middleware(['auth'])
               ->name('news.delete');

Route::get('/news/update/{id}', [UpdateNewsController::class, 'create'])
               ->middleware(['auth']);
Route::post('/news/update', [UpdateNewsController::class, 'update'])
               ->middleware(['auth'])
               ->name('news.update');

Route::get('/news/error', [ErrorNewsController::class, 'create'])
               ->middleware(['auth'])
               ->name('news.list');

require __DIR__.'/auth.php';
