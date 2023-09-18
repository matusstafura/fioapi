<?php

namespace Matusstafura\FioApi;

use Illuminate\Support\Facades\Http;

class HttpClient
{
    public function get(string $url): array
    {
        $response = Http::get($url);

        if ($response->failed()) {
            throw new \Exception('Could not connect to a bank.');
        }

        return $response->json();
    }
}
