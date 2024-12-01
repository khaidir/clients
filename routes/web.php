<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

// admin
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SiaController;
use App\Http\Controllers\admin\SiaPersonController;
use App\Http\Controllers\admin\SiaExtendedController;
use App\Http\Controllers\admin\VisitorController;
use App\Http\Controllers\admin\VisitorPersonController;
use App\Http\Controllers\admin\VisitorPpeController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\PpeController;
use App\Http\Controllers\admin\PpeTypeController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\PermissionsController;

// public
use App\Http\Controllers\public\PublicDashboardController;
use App\Http\Controllers\public\PublicProfileController;
use App\Http\Controllers\public\PublicCompanyController;
use App\Http\Controllers\public\PublicContractsController;
use App\Http\Controllers\public\PublicWorkerController;
use App\Http\Controllers\public\PublicExtendedController;
use App\Http\Controllers\public\PublicHistoryController;

Route::view('/', 'welcome');

Route::get('login', [AuthController::class, 'showLoginForm'])
    ->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)
    ->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// public access
Route::group([
    'middleware' => 'auth'
], function ($router) {

    Route::get('dashboard', [PublicDashboardController::class, 'index'])->name('public.dashboard');

    Route::group([
        'prefix' => 'u',
    ], function ($router) {

        Route::group([
            'prefix' => 'profile',
        ], function ($router) {
            $router->get('/', [PublicProfileController::class, 'index'])->name('public.profile');
            $router->post('store', [PublicProfileController::class, 'store'])->name('public.profile-store');
        });

        Route::group([
            'prefix' => 'company',
        ], function ($router) {
            $router->get('/', [PublicCompanyController::class, 'index'])->name('public.company');
            $router->post('store', [PublicCompanyController::class, 'store'])->name('public.company.store');
        });


        Route::group([
            'prefix' => 'contracts',
        ], function ($router) {

            $router->get('/', [PublicContractsController::class, 'index'])->name('public.contracts');
            $router->get('/data', [PublicContractsController::class, 'getData'])->name('public.contracts.data');

            Route::group([
                'prefix' => 'workers',
            ], function ($router) {
                $router->post('store', [PublicWorkerController::class, 'store'])->name('public.new-worker-store');
                $router->get('/data/{id}', [PublicWorkerController::class, 'getData'])->name('public.new-worker.data');
                $router->get('new/{id}', [PublicWorkerController::class, 'create'])->name('public.new-worker.create');
                $router->get('edit/{id}', [PublicWorkerController::class, 'edit'])->name('public.new-worker.edit');
                $router->get('detail/{id}', [PublicWorkerController::class, 'detail'])->name('public.new-worker.detail');
                $router->get('delete/{id}', [PublicWorkerController::class, 'delete'])->name('public.new-worker.delete');
                $router->get('/{id}', [PublicWorkerController::class, 'index'])->name('public.new-worker.index');
            });

        });

        Route::group([
            'prefix' => 'extended',
        ], function ($router) {
            $router->get('/', [PublicExtendedController::class, 'index'])->name('public.extended');
            $router->get('new', [PublicExtendedController::class, 'create'])->name('public.extended.create');
            $router->get('/data', [PublicExtendedController::class, 'getData'])->name('public.extended.data');
            $router->get('edit/{id}', [PublicExtendedController::class, 'edit'])->name('public.extended.edit');
            $router->post('store', [PublicExtendedController::class, 'store'])->name('public.extended.store');
            $router->get('delete/{id}', [PublicExtendedController::class, 'delete'])->name('public.extended.delete');
        });

        Route::group([
            'prefix' => 'history',
        ], function ($router) {
            $router->get('/', [PublicHistoryController::class, 'index'])->name('public.history');
            $router->get('/data', [PublicHistoryController::class, 'getData'])->name('public.history.data');
        });

    });

});

// admin access
Route::group([
    'middleware' => 'auth'
], function ($router) {

    $router->get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    $router->get('profile', [ProfileController::class, 'index'])->name('profile');
    $router->post('profile/store', [ProfileController::class, 'store'])->name('profile.store');

    Route::group([
        'prefix' => 'worker',
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
            $router->get('detail/{id}', [SiaPersonController::class, 'detail'])->name('sia-person.detail');
            $router->get('delete/{id}', [SiaPersonController::class, 'destroy'])->name('sia-person.delete');
        });

    });

    Route::group([
        'prefix' => 'extend',
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
            $router->post('store-bulk', [VisitorPpeController::class, 'store_bulk'])->name('visitor-ppe.store-bulk');
            $router->get('return/{id}', [VisitorPpeController::class, 'goods_return'])->name('visitor-ppe.return');
            $router->post('upload', [VisitorPpeController::class, 'upload'])->name('visitor-ppe.upload');
            $router->get('edit/{id}', [VisitorPpeController::class, 'edit'])->name('visitor-ppe.edit');
            $router->get('delete/{id}', [VisitorPpeController::class, 'destroy'])->name('visitor-ppe.delete');
        });

    });

    Route::group([
        'prefix' => 'company',
    ], function ($router) {
        $router->get('/', [CompanyController::class, 'index'])->name('company.index');
        $router->get('data', [CompanyController::class, 'getData'])->name('company.data');
        $router->get('new', [CompanyController::class, 'create'])->name('company.create');
        $router->post('store', [CompanyController::class, 'store'])->name('company.store');
        $router->get('edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        $router->get('delete/{id}', [CompanyController::class, 'destroy'])->name('company.delete');
    });



    Route::group([
        'prefix' => 'ppe',
    ], function ($router) {
        $router->get('/', [PpeTypeController::class, 'index'])->name('ppe.index');
        $router->get('data', [PpeTypeController::class, 'getData'])->name('ppe.data');
        $router->get('new', [PpeTypeController::class, 'create'])->name('ppe.create');
        $router->post('store', [PpeTypeController::class, 'store'])->name('ppe.store');
        $router->get('edit/{id}', [PpeTypeController::class, 'edit'])->name('ppe.edit');
        $router->get('units/{id}', [PpeTypeController::class, 'units'])->name('unit.index');
        $router->get('delete/{id}', [PpeTypeController::class, 'destroy'])->name('ppe.delete');

        Route::group([
            'prefix' => 'unit',
        ], function ($router) {
            $router->get('data/{id}', [PpeController::class, 'getData'])->name('unit.data');
            $router->get('new/{id}', [PpeController::class, 'create'])->name('unit.create');
            $router->post('store', [PpeController::class, 'store'])->name('unit.store');
            $router->get('edit/{id}', [PpeController::class, 'edit'])->name('unit.edit');
            $router->get('delete/{id}', [PpeController::class, 'destroy'])->name('unit.delete');
        });

    });

    $router->get('/get-goods/{id}', [VisitorPpeController::class, 'get_good_item'])->name('get-goods');

    // user
    Route::group([
        'prefix' => 'users',
    ], function ($router) {
        $router->get('/', [UsersController::class, 'index'])->name('users.index');
        $router->get('data', [UsersController::class, 'getData'])->name('users.data');
        $router->get('new', [UsersController::class, 'create'])->name('users.create');
        $router->post('store', [UsersController::class, 'store'])->name('pusers.store');
        $router->get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        $router->get('delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');
    });
    Route::group([
        'prefix' => 'roles',
    ], function ($router) {
        $router->get('/', [RolesController::class, 'index'])->name('roles.index');
        $router->get('data', [RolesController::class, 'getData'])->name('roles.data');
        $router->get('new', [RolesController::class, 'create'])->name('roles.create');
        $router->post('store', [RolesController::class, 'store'])->name('roles.store');
        $router->get('edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
        $router->get('delete/{id}', [RolesController::class, 'destroy'])->name('roles.delete');
    });
    Route::group([
        'prefix' => 'permissions',
    ], function ($router) {
        $router->get('/', [PermissionsController::class, 'index'])->name('permissions.index');
        $router->get('data', [PermissionsController::class, 'getData'])->name('permissions.data');
        $router->get('new', [PermissionsController::class, 'create'])->name('permissions.create');
        $router->post('store', [PermissionsController::class, 'store'])->name('permissions.store');
        $router->get('edit/{id}', [PermissionsController::class, 'edit'])->name('permissions.edit');
        $router->get('delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.delete');
    });


});
