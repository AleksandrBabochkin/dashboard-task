<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeMacros();
    }

    /**
     * Макросы для Blade шаблонизатора
     */
    protected function bladeMacros()
    {
        Blade::if('pm', function () {
            return auth()->user() && auth()->user()->role === User::PM;
        });
    }
}
