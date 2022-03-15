<?php

namespace Matusstafura\FioApi;

use Illuminate\Support\ServiceProvider;

class FioReportServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/fio.php' => config_path('fio.php')
        ], 'fio-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fio.php', 'fio');
    }
}