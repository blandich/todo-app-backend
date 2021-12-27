<?php

namespace LawAdvisor\Providers;

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
        $this->app->bind('LawAdvisor\Common\Interfaces\FractalServiceInterface', 'LawAdvisor\Common\Services\FractalService');
        $this->app->bind('LawAdvisor\Common\Interfaces\PaginatorServiceInterface', 'LawAdvisor\Common\Services\PaginatorService');
    }
}
