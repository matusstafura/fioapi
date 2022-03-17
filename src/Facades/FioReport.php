<?php

namespace Matusstafura\FioApi\Facades;

use Illuminate\Support\Facades\Facade;

class FioReport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fio-report';
    }
}