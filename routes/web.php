<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\HoTro\DashboardController;
use App\Http\Controllers\HoTro\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();


Route::get('/hello', function(){
    return 121221;
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
->name('ckfinder_examples');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'hotro',
    'as' => 'hotro.',
], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
    Route::post('/reset-avatar', [UserController::class, 'resetAvatar'])->name('reset-avatar');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/kick-acc', [UserController::class, 'showKickAccForm'])->name('users.kick-acc');
    Route::post('/users/kick-acc', [UserController::class, 'kickAcc']);
    Route::match(['put', 'patch'], '/users/update', [UserController::class, 'update'])->name('users.update');
});

// Route::resource('categories', CategoryController::class);
