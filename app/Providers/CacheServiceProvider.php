<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\StatusExtended;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     *
     *
     * Cache Taglarini faqat boot functionga yozish kerak
     */
    public function boot()
    {
        Cache::tags(['table'])->put('status_extended', StatusExtended::all());
        Cache::tags(['table'])->put('branches',Branch::all());
    }
}
