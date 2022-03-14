<?php

namespace Matusstafura\FioApi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FioReport
{
    public function __construct(protected string $url)
    {
    }

    public function getReport(string $date_from, string $date_to)
    {
        $url = "$this->url/${date_from}/${date_to}/transactions.json";

        $response = Http::get($url);

        if ($response->status() != 200) {
            throw new \Exception('Could not connect to a bank.');
        }

        return $response->json();
    }

    public function today()
    {
        $today = Carbon::today()->toDateString();
        return $this->getReport($today, $today);
    }

    public function yesterday()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        return $this->getReport($yesterday, $yesterday);
    }

    public function betweenDates($date_from, $date_to)
    {
        return $this->getReport($date_from, $date_to);
    }
}