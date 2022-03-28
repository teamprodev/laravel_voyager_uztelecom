<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.dashboard.navbar', function ($view) {
            $view->with('notifications', Notification::query()->where('user_id', auth()->id())->get());
        });
    }
}
