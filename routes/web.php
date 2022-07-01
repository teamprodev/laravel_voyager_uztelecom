<?php

use App\Http\Controllers\EimzoAuthController;
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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ImzoController;
USE App\Http\Controllers\HomeController;

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

Route::controller(BranchController::class)->group(function() {
    Route::post('/branches/{id}/post','update')->name('signers.update');
    Route::get('/branches/ajax_branch','ajax_branch')->name('branches.ajax_branch');
    Route::post('/branches/putCache','putCache')->name('branches.putCache');
    Route::get('/branches/view','view')->name('branches.view');
    Route::get('branches/getData','getData')->name('signers.getData');
});
Route::controller(ReportController::class)->group(function() {
    Route::post('/request','request')->name('request');
    Route::get('/report/request/{id}','report')->name('report');

});
Route::get('roles/getData',[RoleController::class,'getData'])->name('voyager.roles.getData');
Route::get('departments/getData',[DepartmentController::class,'getData'])->name('voyager.departments.getData');
Route::get('department/getData/',[UserController::class,'getData'])->name('voyager.users.getData');
Route::post('/warehouse',[WarehouseController::class,'create'])->name('warehouse.create');
Route::post('/delete_file',[ApplicationController::class,'file_delete'])->name('delete_file');

Route::get('/user/{user}',[UserController::class,'changeLeader'])->name('users.leader');

Route::get('/', function () {
    return redirect()->route('site.applications.index');
});
Route::post('/uploadimage/{application}/update', [ApplicationController::class, 'uploadImage'])->name('uploadImage');
Route::group([
    'prefix' => 'admin',
    'middleware' => 'isAdmin'
], function () {
    Voyager::routes();
    Route::put('roles/{id}/update',[RoleController::class,'update'])->name('voyager.roles.update');
    Route::post('create/role',[RoleController::class,'store'])->name('voyager.roles.store');
    Route::put('users/{id}/update',[UserController::class,'update'])->name('voyager.users.update');
    Route::get('roles/',[RoleController::class,'index'])->name('voyager.roles.index');
    Route::get('departments/',[DepartmentController::class,'index'])->name('voyager.departments.index');
    Route::get('type-of-purchase/{id}/edit',[TypeOfPurchase::class,'edit'])->name('voyager.type-of-purchase.edit');
    Route::post('type-of-purchase/update',[TypeOfPurchase::class,'update'])->name('type-of-purchase.update');
    Route::get('branches/{id}/signers',[BranchController::class,'edit'])->name('signers.add');

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
                    Route::get('{id}/show', [ProfileController::class, 'other'])->name('other');
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
                    Route::post('performer_status/post', [ApplicationController::class, 'performer_status_post'])->name('performer_status_post')->middleware('branch');
                    Route::get('performer_status/show', [ApplicationController::class, 'performer_status'])->name('performer_status');
                    Route::get('list', [ApplicationController::class, 'getdata'])->name('list');
                    Route::get('list/signedocs/{application}', [ApplicationController::class, 'SignedDocs'])->name('list.signedocs');
                    Route::get('{application}/show/{view?}', [ApplicationController::class, 'show'])->name('show')->middleware('branch');
                    Route::get('{application}/edit', [ApplicationController::class, 'edit'])->name('edit')->middleware('branch');
                    Route::get('{application}/clone', [ApplicationController::class, 'clone'])->name('clone')->middleware('branch','application_user_id');
                    Route::post('{application}/update', [ApplicationController::class, 'update'])->name('update')->middleware('branch');
                    Route::get('{application}/destroy', [ApplicationController::class, 'destroy'])->name('destroy')->middleware('branch','application_user_id');
                    Route::get('create', [ApplicationController::class, 'create'])->name('create')->middleware('branch');
                    Route::post('store', [ApplicationController::class, 'store'])->name('store')->middleware('branch');
                    Route::put('{application}/vote', [ApplicationController::class, 'vote'])->name('vote')->middleware('branch');
                    Route::post('{application}/is_more_than_limit', [ApplicationController::class, 'is_more_than_limit'])->name('is_more_than_limit')->middleware('branch','application_user_id');
                    Route::get('getAll', [ApplicationController::class, 'getAll'])->name('getAll');
                    Route::post('applications/{application}/eimzo/sign', [ImzoController::class, 'verifyPks'])->name('imzo.sign');
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
Route::get('/home', [HomeController::class, 'index']);
Route::get('/test/{id}', [App\Http\Controllers\Controller::class, 'test']);

Route::get('getRoles', [ApplicationController::class, '']);
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


