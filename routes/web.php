<?php

use App\Http\Controllers\EimzoAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Site\DashboardController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Site\FaqsController;
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

Route::get('/', function () {
    return redirect()->route('site.applications.index');
});
Route::post('/uploadimage/{application}/update', [ApplicationController::class, 'uploadImage'])->name('uploadImage');
Route::group([
    'prefix' => 'admin',
    'middleware' => 'isAdmin'
], function () {
    Voyager::routes();


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
                    Route::get('list', [ApplicationController::class, 'getdata'])->name('list');
                    Route::get('list/signedocs', [ApplicationController::class, 'SignedDocs'])->name('list.signedocs');
                    Route::get('{application}/show', [ApplicationController::class, 'show'])->name('show');
                    Route::get('{application}/edit', [ApplicationController::class, 'edit'])->name('edit');
                    Route::post('{application}/update', [ApplicationController::class, 'update'])->name('update');
                    Route::get('create', [ApplicationController::class, 'create'])->name('create');
                    Route::post('store', [ApplicationController::class, 'store'])->name('store');
                    Route::put('{application}/vote', [ApplicationController::class, 'vote'])->name('vote');
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
                    Route::get('', [FaqsController::class, 'index'])->name('index');

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


