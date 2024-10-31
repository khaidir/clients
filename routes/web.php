<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SiaController;
use App\Http\Controllers\admin\SiaPersonController;
use App\Http\Controllers\admin\SiaExtendedController;

use App\Http\Controllers\admin\VisitorController;
use App\Http\Controllers\admin\VisitorPersonController;
use App\Http\Controllers\admin\VisitorPpeController;
use App\Http\Controllers\admin\CompanyController;


Route::view('/', 'welcome');

Route::get('login', [AuthController::class, 'showLoginForm'])
    ->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)
    ->name('login');
Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('public/dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard');

Route::group([
    'middleware' => 'auth'
], function ($router) {
    $router->get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    $router->get('profile', [ProfileController::class, 'index'])->name('profile');
    $router->post('store', [ProfileController::class, 'store'])->name('profile.store');
});

Route::group([
    'prefix' => 'worker',
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
    'prefix' => 'extend',
    'middleware' => 'auth'
], function ($router) {
    $router->get('/', [SiaExtendedController::class, 'index'])->name('extended.index');
    $router->get('/data', [SiaExtendedController::class, 'getData'])->name('extended.data');
    $router->get('new', [SiaExtendedController::class, 'create'])->name('extended.create');
    $router->post('store', [SiaExtendedController::class, 'store'])->name('extended.store');
    $router->get('edit/{id}', [SiaExtendedController::class, 'edit'])->name('extended.edit');
    $router->get('delete/{id}', [SiaExtendedController::class, 'destroy'])->name('extended.delete');

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
    $router->get('person/{id}', [VisitorController::class, 'person'])->name('visitor-person.index');
    $router->get('ppe/{id}', [VisitorController::class, 'ppe'])->name('visitor-ppe.index');
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

    Route::group([
        'prefix' => 'ppe',
    ], function ($router) {
        $router->get('/get-goods/{id}', [VisitorPpeController::class, 'get_good_item'])->name('visitor-ppe.get-goods');
        $router->get('/data/{id}', [VisitorPpeController::class, 'getData'])->name('visitor-ppe.data');
        $router->get('new/{id}', [VisitorPpeController::class, 'create'])->name('visitor-ppe.create');
        $router->get('new-bulk/{id}', [VisitorPpeController::class, 'create_bulk'])->name('visitor-ppe.create-bulk');
        $router->post('store', [VisitorPpeController::class, 'store'])->name('visitor-ppe.store');
        $router->post('store-bulk', [VisitorPpeController::class, 'store-bulk'])->name('visitor-ppe.store-bulk');
        $router->get('return/{id}', [VisitorPpeController::class, 'goods_return'])->name('visitor-ppe.return');
        $router->post('upload', [VisitorPpeController::class, 'upload'])->name('visitor-ppe.upload');
        $router->get('edit/{id}', [VisitorPpeController::class, 'edit'])->name('visitor-ppe.edit');
        $router->get('delete/{id}', [VisitorPpeController::class, 'destroy'])->name('visitor-ppe.delete');
    });

});

Route::group([
    'prefix' => 'company',
    'middleware' => 'auth'
], function ($router) {
    $router->get('/', [CompanyController::class, 'index'])->name('company.index');
    $router->get('data', [CompanyController::class, 'getData'])->name('company.data');
    $router->get('new', [CompanyController::class, 'create'])->name('company.create');
    $router->post('store', [CompanyController::class, 'store'])->name('company.store');
    $router->get('edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    $router->get('delete/{id}', [CompanyController::class, 'destroy'])->name('company.delete');
});

$router->get('/get-goods/{id}', [VisitorPpeController::class, 'get_good_item'])->name('get-goods');
