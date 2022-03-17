<?php

declare(strict_types=1);

namespace Matusstafura\FioApi;

final class FioApiService
{
    public function baseUrl(): string
    {
        return config('fio.prefixUrl').config('fio.token');
    }
}
