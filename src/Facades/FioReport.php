<?php

declare(strict_types=1);

namespace Matusstafura\FioApi\Facades;

use Illuminate\Support\Facades\Facade;

final class FioReport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fio-report';
    }
}
