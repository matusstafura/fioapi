<?php

namespace Matusstafura\FioApi;

class FioApiService
{
    public function baseUrl()
    {
        return config('fio.prefixUrl').config('fio.token');
    }
}