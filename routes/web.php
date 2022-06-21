<?php

use App\Http\Controllers\EimzoAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TypeOfPurchase;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Site\DashboardController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Site\FaqsController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/report/request/{id}',[ReportController::class,'report'])->name('report');
Route::get('roles/getData',[\App\Http\Controllers\RoleController::class,'getData'])->name('voyager.roles.getData');


Route::post('/request',[ReportController::class,'request'])->name('request');
Route::post('/warehouse',[WarehouseController::class,'create'])->name('warehouse.create');

Route::get('/user/{user}',[UserController::class,'changeLeader'])->name('users.leader');
Route::post('/branches/{id}/post',[\App\Http\Controllers\BranchController::class,'update'])->name('signers.update');

Route::get('/branches/ajax_branch',[\App\Http\Controllers\BranchController::class,'ajax_branch'])->name('branches.ajax_branch');
Route::post('/branches/putCache',[\App\Http\Controllers\BranchController::class,'putCache'])->name('branches.putCache');
Route::get('/branches/view',[\App\Http\Controllers\BranchController::class,'view'])->name('branches.view');

Route::get('/', function () {
    return redirect()->route('site.applications.index');
});
Route::get('branches/getData',[\App\Http\Controllers\BranchController::class,'getData'])->name('signers.getData');
Route::post('/uploadimage/{application}/update', [ApplicationController::class, 'uploadImage'])->name('uploadImage');
Route::group([
    'prefix' => 'admin',
    'middleware' => 'isAdmin'
], function () {
    Voyager::routes();
    Route::put('roles/{id}/update',[\App\Http\Controllers\RoleController::class,'update'])->name('voyager.roles.update');
    Route::get('roles/',[\App\Http\Controllers\RoleController::class,'index'])->name('voyager.roles.index');
    Route::get('roles/{id}/delete',[\App\Http\Controllers\RoleController::class,'delete'])->name('voyager.roles.delete');
    Route::get('type-of-purchase/{id}/edit',[TypeOfPurchase::class,'edit'])->name('voyager.type-of-purchase.edit');
    Route::post('type-of-purchase/update',[TypeOfPurchase::class,'update'])->name('type-of-purchase.update');
    Route::get('branches/{id}/signers',[\App\Http\Controllers\BranchController::class,'edit'])->name('signers.add');

});
Route::get('admin/login', [LoginController::class, 'login'])->name('voyager.login');
Route::post('admin/login', [LoginController::class, 'postLogin'])->name('voyager.login');

Auth::routes();

Route::post('eimzo/login', [EimzoAuthController::class, 'auth'])->name('eri.login');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
], function()
{
    Route::group(
        [
            'as' => 'site.',
            'prefix' => 'site',
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

        ],

        function(){
            Route::group(
                [
                    'as' => 'profile.',
                    'prefix' => 'profile',
                ],
                function(){
                    Route::get('', [ProfileController::class, 'index'])->name('index');
                    Route::put('update', [ProfileController::class, 'update'])->name('update');
                });
                Route::group(
                    [
                        'as' => 'report.',
                        'prefix' => 'report',
                    ],
                    function(){
                        Route::get('/{id}',[ReportController::class,'index'])->name('index');
                    });
            Route::group(
                [
                    'as' => 'applications.',
                    'prefix' => 'applications',
                ],
                function(){
                    Route::group(
                        [
                            'as' => 'drafts',
                            'prefix' => 'drafts',
                        ],
                    function (){
                        Route::get('', [ApplicationController::class, 'show_draft']);
                    });
                    Route::get('', [ApplicationController::class, 'index'])->name('index');
                    Route::get('{status}/show_status', [ApplicationController::class, 'show_status'])->name('show_status');
                    Route::get('status_table/show', [ApplicationController::class, 'status_table'])->name('status_table');
                    Route::get('performer_status', [ApplicationController::class, 'performer_status_get'])->name('performer_status_get');
                    Route::post('performer_status/post', [ApplicationController::class, 'performer_status_post'])->name('performer_status_post');
                    Route::get('performer_status/show', [ApplicationController::class, 'performer_status'])->name('performer_status');
                    Route::get('list', [ApplicationController::class, 'getdata'])->name('list');
                    Route::get('list/signedocs/{application}', [ApplicationController::class, 'SignedDocs'])->name('list.signedocs');
                    Route::get('{application}/show/{view?}', [ApplicationController::class, 'show'])->name('show');
                    Route::get('{application}/edit', [ApplicationController::class, 'edit'])->name('edit');
                    Route::get('{application}/clone', [ApplicationController::class, 'clone'])->name('clone');
                    Route::post('{application}/update', [ApplicationController::class, 'update'])->name('update');
                    Route::get('{application}/destroy', [ApplicationController::class, 'destroy'])->name('destroy');
                    Route::get('create', [ApplicationController::class, 'create'])->name('create');
                    Route::post('store', [ApplicationController::class, 'store'])->name('store');
                    Route::put('{application}/vote', [ApplicationController::class, 'vote'])->name('vote');
                    Route::post('{application}/is_more_than_limit', [ApplicationController::class, 'is_more_than_limit'])->name('is_more_than_limit');
//                    Route::post('cancel', [ApplicationController::class, 'cancel'])->name('cancel');

                    Route::get('getAll', [ApplicationController::class, 'getAll'])->name('getAll');
                    Route::post('applications/{application}/eimzo/sign', [\App\Http\Controllers\ImzoController::class,
                        'verifyPks'])
                        ->name('imzo.sign');
                });

            Route::group(
                [
                    'as' => 'faqs.',
                    'prefix' => 'faqs',
                ],
                function(){
                    Route::get('', [FaqsController::class, 'index'])->name(   'index');

                    Route::get('{faq}/show', [FaqsController::class, 'show'])->name('show');
                    Route::get('{faq}/edit', [ApplicationController::class, 'edit'])->name('edit');
                    Route::post('{faq}/update', [ApplicationController::class, 'update'])->name('update');
                    Route::get('create', [ApplicationController::class, 'create'])->name('create');
                    Route::post('{application}/store', [ApplicationController::class, 'store'])->name('store');
                    Route::post('form', [ApplicationController::class, 'form'])->name('form');
                    Route::get('getAll', [ApplicationController::class, 'getAll'])->name('getAll');

                });
            Route::group(
                [
                    'as' => 'dashboard.',
                    'prefix' => 'dashboard'
                ],
                function(){
                    Route::get('index', [DashboardController::class, 'index'])->name('index');

                });
        }
    );

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/test/{id}', [App\Http\Controllers\Controller::class, 'test']);

Route::get('/layout', function () {
    return view('site.auth.layout');
});

Route::get('/profile', function () {
    return view('site.profile.profile');
});
Route::get('/faq/index', function () {
    return view('site.faq.index');
});
Route::get('/faq/show', function () {
    return view('site.faq.show');
});
Route::get('/test', function () {
    return view('site.test');
});
Route::get('getRoles', [ApplicationController::class, '']);
//Route::get('/test/send', [\App\Http\Controllers\TestController::class, 'index']);
//Route::get('test/send', function () {
//    event(new App\Events\NotificationEvent('Monika'));
//    return "Event has been sent!";
//});
Route::get('sign/index', function () {
    return redirect()->route('site.applications.index');
})->name('sign.index');
Route::get('redirect', function (){
    return redirect()->route('site.applications.index');
})->name('eimzo.auth.back');
Route::get('eimzo/back',  function(){
    return redirect()->route('site.applications.index');
})->name('eimzo.back');
Route::get('eimzo/login', [EimzoAuthController::class, 'login'])->name('eimzo.login.index');


