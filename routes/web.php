<?php

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

Route::get('/', [App\Http\Controllers\mainController::class, 'directionsBlade'])->name('main.index');

Route::get('/portfolio/{id}',[App\Http\Controllers\mainController::class, 'portfolioBlade'])->name('portfolio.index');

Route::view('/loginAdmin', 'admin/login')->name('admin.login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::post('/getApplication',[App\Http\Controllers\ApplicationController::class, 'index'])->name('getApplication');

Route::middleware('auth.token')->group(function (){
    Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('admin.index');
    Route::put('/renamePass', [App\Http\Controllers\renamepassController::class, 'renamePass'])->name('renamePass');
    Route::get('/logout', [App\Http\Controllers\logoutController::class, 'logout'])->name('logout');

    Route::post('/direction', [App\Http\Controllers\adminController::class, 'firstOrCreateDirection'])->name('createDirection');
    Route::delete('/direction', [App\Http\Controllers\adminController::class, 'deleteDirection'])->name('deleteDirection');
    Route::patch('/direction', [App\Http\Controllers\adminController::class, 'redactDirection'])->name('redactDirection');

    Route::get('/adminPortfolio/{id}', [App\Http\Controllers\adminController::class, 'adminPortfolioBlade'])->name('adminPortfolioBlade');
    Route::get('/adminPortfolio/element/{id}', [App\Http\Controllers\adminController::class, 'adminPortfolioElementBlade'])->name('adminPortfolioElementBlade');

    Route::post('/portfolio', [App\Http\Controllers\adminController::class, 'createPortfolio'])->name('createPortfolio');
    Route::delete('/portfolio', [App\Http\Controllers\adminController::class, 'deletePortfolio'])->name('deletePortfolio');
    Route::patch('/portfolio', [App\Http\Controllers\adminController::class, 'redactPortfolio'])->name('redactPortfolio');

    Route::post('/media', [App\Http\Controllers\adminController::class, 'createMedia'])->name('createMedia');
    Route::delete('/media', [App\Http\Controllers\adminController::class, 'deleteMedia'])->name('deleteMedia');
    Route::patch('/media', [App\Http\Controllers\adminController::class, 'redactMedia'])->name('redactMedia');

    Route::get('/adminApplications', [App\Http\Controllers\ApplicationController::class, 'applicationsBlade'])->name('adminApplications');
    Route::patch('/trueApplication', [App\Http\Controllers\ApplicationController::class, 'trueApplication'])->name('trueApplication');
    Route::patch('/falseApplication', [App\Http\Controllers\ApplicationController::class, 'falseApplication'])->name('falseApplication');

    Route::get('/adminPartners', [App\Http\Controllers\adminPartnersController::class, 'index'])->name('adminPartners');
    Route::post('/partners', [App\Http\Controllers\adminPartnersController::class, 'createPartner'])->name('createPartner');
    Route::delete('/partners', [App\Http\Controllers\adminPartnersController::class, 'deletePartner'])->name('deletePartner');
});

