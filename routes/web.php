<?php

use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PeopleController;
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

        Route::group(['middleware' => 'is_admin'], function(){
            Route::get('/create', [OrganizationController::class,'create'])->name('create');
            Route::post('/store', [OrganizationController::class,'store'])->name('store');
            Route::delete('{organization}',[OrganizationController::class, 'destroy'])->name('delete');
        });

        Route::group(['middleware' => 'assigned_organization'], function(){
            Route::get('/edit/{organization}', [OrganizationController::class, 'edit'])->name('edit');
            Route::put('/update/{organization}', [OrganizationController::class, 'update'])->name('update');
        });
        
        // PEOPLE
        Route::group(['prefix' => '{organization}/people','middleware' => 'assigned_organization', 'as' => 'people.' ], function(){
            Route::get('/create', [PeopleController::class, 'create'])->name('create');
            Route::get('/edit/{person}', [PeopleController::class, 'edit'])->name('edit');
            Route::post('/store', [PeopleController::class, 'store'])->name('store');
            Route::put('/update/{person}', [PeopleController::class, 'update'])->name('update');
            Route::delete('{person}',[PeopleController::class, 'destroy'])->name('delete');
        });
    
        // ACCOUNT MANAGER
        Route::group(['prefix' => '{organization}/account-manager','middleware'=>'is_admin', 'as' => 'account-manager.'], function(){
            Route::get('/create', [AccountManagerController::class, 'create'])->name('create');
            Route::post('/store/{user}', [AccountManagerController::class, 'store'])->name('store');
            Route::delete('/',[AccountManagerController::class, 'destroy'])->name('delete');
        });
    });
});


require __DIR__.'/auth.php';
