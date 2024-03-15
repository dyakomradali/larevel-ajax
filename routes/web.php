<?php

use App\Http\Controllers\Controllerstages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/delete-stage', [Controllerstages::class, 'deletestage'])->name('delete.stage')->middleware(['auth']);

});
Route::get('/', [Controllerstages::class, "stages"])->middleware('auth');
Route::post('/add_stage', [Controllerstages::class, 'addstages'])->name('add.stages');
Route::post('/update-stage', [Controllerstages::class, 'updatestage'])->name('update.stage');
Route::get('/pagination/paginate-data', [Controllerstages::class, 'pagination'])->name('pagination.data');
Route::get('/searchstages', [Controllerstages::class, 'searchstages'])->name('aa.stage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
