<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
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
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home',DashboardController::class)->name('home');

    Route::group(['prefix' => 'organization', 'as' => 'organization.'], function(){
        Route::get('/show/{organization}', [OrganizationController::class,'show'])->name('show');
        Route::get('/create', [OrganizationController::class,'create'])->name('create');
        Route::post('/store', [OrganizationController::class,'store'])->name('store');
        Route::get('/edit/{organization}', [OrganizationController::class, 'edit'])->name('edit');
        Route::put('/update/{organization}', [OrganizationController::class, 'update'])->name('update');
        Route::delete('{organization}',[OrganizationController::class, 'destroy'])->name('delete');
    });
});


require __DIR__.'/auth.php';
