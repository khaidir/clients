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
use App\Http\Controllers\admin\TokenController;
use App\Http\Controllers\admin\VisitorPersonController;
use App\Http\Controllers\admin\VisitorPpeController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\PicController;
use App\Http\Controllers\admin\PpeController;
use App\Http\Controllers\admin\PpeTypeController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\PermissionsController;

// public
use App\Http\Controllers\public\PublicDashboardController;
use App\Http\Controllers\public\PublicProfileController;
use App\Http\Controllers\public\PublicCompanyController;
use App\Http\Controllers\public\PublicVisitorController;
use App\Http\Controllers\public\PublicContractsController;
use App\Http\Controllers\public\PublicWorkerController;
use App\Http\Controllers\public\PublicExtendedController;
use App\Http\Controllers\public\PublicHistoryController;

// Route::view('/', 'welcome');

Route::get('login', [AuthController::class, 'showLoginForm'])
->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)
->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'register_form']);
Route::post('register', [AuthController::class, 'register']);

Route::get('direct/i/{token}', [PublicVisitorController::class, 'direct_token'])->name('visitor-directtoken');

Route::get('/vp', [PublicVisitorController::class, 'landing'])->name('visitor-public-landing');
Route::get('invite/{token}', [PublicVisitorController::class, 'index'])->name('visitor-public');
Route::get('invite/draft/{token}', [PublicVisitorController::class, 'draft'])->name('visitor-public-draft');
Route::post('invite', [PublicVisitorController::class, 'store'])->name('visitor-public-store');
Route::post('invite/upload', [PublicVisitorController::class, 'upload'])->name('visitor-public-upload');
Route::get('invite/delete/{id}', [PublicVisitorController::class, 'destroy'])->name('visitor-public-delete');

Route::get('setuju/{id}', [PublicVisitorController::class, 'setuju'])->name('visitor-public-setuju');
Route::get('reject/{id}', [PublicVisitorController::class, 'reject'])->name('visitor-public-reject');
Route::post('rejected', [PublicVisitorController::class, 'rejected']);

Route::get('/mail', [PublicVisitorController::class, 'sendmailuser']);

// public access
Route::group([
    'middleware' => 'auth'
], function ($router) {

    Route::get('/', [PublicDashboardController::class, 'index'])->name('public.dashboard');

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
            $router->get('new', [PublicContractsController::class, 'create'])->name('public.contracts.create');
            $router->get('edit/{id}', [PublicContractsController::class, 'edit'])->name('public.contracts.edit');
            $router->get('detail/{id}', [PublicContractsController::class, 'detail'])->name('public.contracts.detail');
            $router->get('delete/{id}', [PublicContractsController::class, 'delete'])->name('public.contracts.delete');

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

// });

// // admin access
// Route::group([
//     'middleware' => 'auth'
// ], function ($router) {

    $router->get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
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
            $router->post('reason/{id}', [SiaPersonController::class, 'reason'])->name('sia-person.reason');
            $router->post('checked/{id}', [SiaPersonController::class, 'checked'])->name('sia-person.checked');

            Route::group([
                'prefix' => 'approve',
            ], function ($router) {
                $router->get('/end-user/{id}', [SiaPersonController::class, 'approve']);
                $router->get('hod/{id}', [SiaPersonController::class, 'approve']);
                $router->get('purchasing/{id}', [SiaPersonController::class, 'approve']);
                $router->get('legal/{id}', [SiaPersonController::class, 'approve']);
                $router->get('hs/{id}', [SiaPersonController::class, 'approve']);
                $router->get('health/{id}', [SiaPersonController::class, 'approve']);
            });
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
        $router->post('/visitor/mass-delete', [VisitorController::class, 'massDelete'])->name('visitor.massDelete');
        $router->post('/visitor/mass-approve', [VisitorController::class, 'massApprove'])->name('visitor.massApprove');


        $router->get('approve/pic/{id}', [VisitorController::class, 'pic'])->name('visitor-approve.pic');
        $router->get('approve/security/{id}', [VisitorController::class, 'security'])->name('visitor-approve.security');
        $router->get('approve/safety/{id}', [VisitorController::class, 'safety'])->name('visitor-approve.safety');

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
            'prefix' => 'token',
        ], function ($router) {
            $router->get('/', [TokenController::class, 'index'])->name('token.index');
            $router->get('/data', [TokenController::class, 'getData'])->name('token.data');
            $router->get('new', [TokenController::class, 'create'])->name('token.create');
            $router->post('store', [TokenController::class, 'store'])->name('token.store');
            $router->post('upload', [TokenController::class, 'upload'])->name('token.upload');
            $router->get('edit/{id}', [TokenController::class, 'edit'])->name('tokenn.edit');
            $router->get('delete/{id}', [TokenController::class, 'destroy'])->name('token.delete');
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
        'prefix' => 'pic',
    ], function ($router) {
        $router->get('/', [PicController::class, 'index'])->name('pic.index');
        $router->get('data', [PicController::class, 'getData'])->name('pic.data');
        $router->get('new', [PicController::class, 'create'])->name('pic.create');
        $router->post('store', [PicController::class, 'store'])->name('pic.store');
        $router->get('edit/{id}', [PicController::class, 'edit'])->name('pic.edit');
        $router->get('delete/{id}', [PicController::class, 'destroy'])->name('pic.delete');
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
