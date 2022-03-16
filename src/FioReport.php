<?php

namespace Matusstafura\FioApi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FioReport
{
    public function __construct(public string $date_from, public string $date_to)
    {
    }

    public function getReport()
    {
        $fioApiService = new FioApiService();
        $url = $fioApiService->baseUrl()."/$this->date_from/$this->date_to/transactions.json";

        $response = Http::get($url);

        if ($response->status() != 200) {
            throw new \Exception('Could not connect to a bank.');
        }

        return $response->json();
    }

    public static function betweenDates(string $date_from, string $date_to): static
    {
        try {
            $date_from = Carbon::parse($date_from)->format('Y-m-d');
            $date_to = Carbon::parse($date_to)->format('Y-m-d');

            return new static($date_from, $date_to);
        } catch (\Exception $e) {
            throw new \Exception("Invalid input date.");
        }
    }

    public static function today(): static
    {
        $today = Carbon::today()->toDateString();
        return new static($today, $today);
    }

    public static function yesterday(): static
    {
        $yesterday = Carbon::yesterday()->toDateString();
        return new static($yesterday, $yesterday);
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = Carbon::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }


}