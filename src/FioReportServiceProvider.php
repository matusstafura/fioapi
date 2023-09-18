<?php

declare(strict_types=1);

namespace Matusstafura\FioApi;

use Illuminate\Support\ServiceProvider;

final class FioReportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/fio.php' => config_path('fio.php'),
        ], 'fio-report');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fio.php', 'fio');

        $this->app->singleton('fio-report', function () {
            return new FioReport(new FioApiService(), new HttpClient());
        });
    }
}
