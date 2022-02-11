<?php

use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Site\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    return redirect()->route('site.applications.create');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'isAdmin'
], function () {
    Voyager::routes();


});
Route::get('admin/login', [LoginController::class, 'login'])->name('voyager.login');
Route::post('admin/login', [LoginController::class, 'postLogin'])->name('voyager.login');

Auth::routes();


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::group(
        [
            'as' => 'site.',
            'prefix' => 'site'
        ],
        function(){
            Route::group(
                [
                    'as' => 'applications.',
                    'prefix' => 'applications',
                    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
                ],
                function(){
                    Route::get('', [ApplicationController::class, 'index'])->name('index');
                    Route::get('show', [ApplicationController::class, 'show'])->name('show');
                    Route::get('edit', [ApplicationController::class, 'edit'])->name('edit');
                    Route::get('update', [ApplicationController::class, 'update'])->name('update');
                    Route::get('create', [ApplicationController::class, 'create'])->name('create');
                    Route::get('store', [ApplicationController::class, 'store'])->name('store');
                    Route::post('form', [ApplicationController::class, 'form'])->name('form');
                    Route::get('base', [ApplicationController::class, 'base'])->name('base');
                });
            Route::group(
                [
                    'as' => 'dashboard.',
                    'prefix' => 'dashboard'
                ],
                function(){
                    Route::get('', [DashboardController::class, 'index'])->name('index');

                });
        }
    );

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/layout', function () {
    return view('site.auth.layout');
});

Route::get('/profile', function () {
    return view('site.profile.profile');
});
