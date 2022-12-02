<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertController;
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
Route::get('/', [AdvertController::class, 'index']);
Route::get('/advert/click/{id}', [AdvertController::class,'click'])->name('advert.click');

Route::group(['middleware' => 'auth'], function() {
	Route::get('/adverts', [AdvertController::class,'adverts'])->name('adverts');
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/create_pdf', [DocumentController::class, 'create_pdf']);
	Route::post('/save_pdf', [DocumentController::class, 'save_pdf']);
	Route::get('/export-csv', function () {
	     return Excel::download(new \App\Exports\VacancyExport, 'vacancies.xlsx');
	});
});

Auth::routes();
