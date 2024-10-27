<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\SiaController;
use App\Http\Controllers\admin\SiaPersonController;

use App\Http\Controllers\admin\VisitorController;
use App\Http\Controllers\admin\VisitorPersonController;


Route::view('/', 'welcome');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('public/dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard');

Route::group([
    'prefix' => 'sia',
    'middleware' => 'auth'
], function ($router) {
    $router->get('/', [SiaController::class, 'index'])->name('sia.index');
    $router->get('/data', [SiaController::class, 'getData'])->name('sia.data');
    $router->get('new', [SiaController::class, 'create'])->name('sia.create');
    $router->post('store', [SiaController::class, 'store'])->name('sia.store');
    $router->get('edit/{id}', [SiaController::class, 'edit'])->name('sia.edit');
    $router->get('detail/{id}', [SiaController::class, 'detail'])->name('sia.detail');
    $router->get('delete/{id}', [SiaController::class, 'destroy'])->name('sia.delete');

    Route::group([
        'prefix' => 'person',
    ], function ($router) {
        $router->get('/data/{id}', [SiaPersonController::class, 'getData'])->name('sia-person.data');
        $router->get('new/{id}', [SiaPersonController::class, 'create'])->name('sia-person.create');
        $router->post('store', [SiaPersonController::class, 'store'])->name('sia-person.store');
        $router->post('upload', [SiaPersonController::class, 'upload'])->name('sia-person.upload');
        $router->get('edit/{id}', [SiaPersonController::class, 'edit'])->name('sia-person.edit');
        $router->get('delete/{id}', [SiaPersonController::class, 'destroy'])->name('sia-person.delete');
    });

});

Route::group([
    'prefix' => 'visitor',
    'middleware' => 'auth'
], function ($router) {
    $router->get('/', [VisitorController::class, 'index'])->name('visitor.index');
    $router->get('/data', [VisitorController::class, 'getData'])->name('visitor.data');
    $router->get('new', [VisitorController::class, 'create'])->name('visitor.create');
    $router->post('store', [VisitorController::class, 'store'])->name('visitor.store');
    $router->get('edit/{id}', [VisitorController::class, 'edit'])->name('visitor.edit');
    $router->get('detail/{id}', [VisitorController::class, 'detail'])->name('visitor.detail');
    $router->get('delete/{id}', [VisitorController::class, 'destroy'])->name('visitor.delete');

    Route::group([
        'prefix' => 'person',
    ], function ($router) {
        $router->get('/data/{id}', [VisitorPersonController::class, 'getData'])->name('visitor-person.data');
        $router->get('new/{id}', [VisitorPersonController::class, 'create'])->name('visitor-person.create');
        $router->post('store', [VisitorPersonController::class, 'store'])->name('visitor-person.store');
        $router->post('upload', [VisitorPersonController::class, 'upload'])->name('visitor-person.upload');
        $router->get('edit/{id}', [VisitorPersonController::class, 'edit'])->name('visitor-person.edit');
        $router->get('delete/{id}', [VisitorPersonController::class, 'destroy'])->name('visitor-person.delete');
    });

});

