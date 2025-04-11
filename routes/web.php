<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MenuGroupController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupPermissionController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ClientandproductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DocferifyController;
use App\Http\Controllers\DocumenctferifyController;
use App\Http\Controllers\DocumenctferifyReviewController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\bankController;
use App\Http\Controllers\ChartConfigController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\ChartdinamisController;
use App\Http\Controllers\ChartdetailController;
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
 

Route::get('/sss', function () {
    return view('errors.404');
})->name('noaccess');


Route::get('/sss', function () {
    return view('errors.404');
})->name('noaccess');
Route::get('/sss', function () {
    return view('errors.404');
})->name('#');
Route::get('/errssdsd', function () {
    return view('errors.401');
})->name('notfound');

Route::permanentRedirect('/', 'login');
 

Route::resource('menus', MenuController::class);
Route::post('/menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.updateOrder');
Route::post('/menus/update-tree', [MenuController::class, 'updateTree'])->name('menus.updateTree');
Route::post('/update-dov', [DocumenctferifyReviewController::class, 'updateDov']);

// Route::get('/menusbaru', [MenuController::class, 'index']);
Route::post('/menus/update-order', [MenuController::class, 'updateOrder']);
Route::post('/menus/update-status', [MenuController::class, 'updateStatus'])->name('menus.updateStatus');

Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::resource('chacrtdetail', ChartdetailController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('chart', ChartdinamisController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('stakeholder', StakeholderController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('transaksi', TransaksiController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);
    Route::resource('piutang', PiutangController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('bank', bankController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('kategori', kategoriController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('pt', PTController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('documenctferify', DocumenctferifyController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);
    Route::resource('documenctferifyreview', DocumenctferifyReviewController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('docferify', DocferifyController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('clientandproduct', ClientandproductController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('pic', PicController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('grouppermission', GroupPermissionController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('group', GroupController::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print', 'show']);

    Route::resource('dashboard', DashboardController::class)->only('index');
    Route::resource('user', UserManagementController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    Route::prefix('user')->group(function () {
        Route::resource('profile', UserProfileController::class)->only('index');
    });
    Route::resource('setting', SettingController::class)->only('index', 'update');

    Route::resource('route', RouteController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    Route::resource('role', RoleController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    Route::resource('permission', PermissionController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');

    Route::resource('menu', MenuGroupController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    Route::resource('menu.item', MenuItemController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');

    Route::resource('pelatihan', PelatihanController::class)->only('index');
    Route::resource('icon', IconController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    Route::resource('combo', ComboController::class)->only('index', 'store', 'update', 'destroy','create', 'edit','print', 'show');
    
    // Route::get('comboCreate',[ComboController::class, 'comboCreate'])->name('comboCreate');
 
    Route::get('/chart-builder', [DashboardController::class, 'chartBuilder'])->name('chart.builder');
    Route::get('/chart-sync', [DashboardController::class, 'sync'])->name('chart.builder');
    // Route::get('/chart-builder', [ChartController::class, 'index'])->name('chart.builder');
Route::post('/chart-data', [ChartController::class, 'getData'])->name('chart.data');

Route::post('/simpan-chart-config', [ChartConfigController::class, 'store'])
     ->name('chart.store');
 
     Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');
Route::get('/chart/data/{id}', [ChartController::class, 'chartBuilderData'])->name('chart.builder');


});
