<?php

namespace Matusstafura\FioApi\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Matusstafura\FioApi\FioReportServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            FioReportServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

    }
}