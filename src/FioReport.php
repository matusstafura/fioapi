<?php

namespace Matusstafura\FioApi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FioReport
{
    public function __construct(protected FioApiService $fioApiService)
    {
    }

    public function getReport($date_from, $date_to)
    {
        $url = $this->fioApiService->baseUrl()."/${date_from}/${date_to}/transactions.json";

        $response = Http::get($url);

        if ($response->status() != 200) {
            throw new \Exception('Could not connect to a bank.');
        }

        return $response->json();
    }

    public function betweenDates(string $date_from, string $date_to)
    {
        try {
            $date_from = Carbon::parse($date_from)->format('Y-m-d');
            $date_to = Carbon::parse($date_to)->format('Y-m-d');

            return $this->getReport($date_from, $date_to);
        } catch (\Exception $e) {
            throw new \Exception("Invalid input date.");
        }
    }

    public function today()
    {
        return $this->getReport($this->todayDate(), $this->todayDate());
    }

    public function yesterday()
    {
        return $this->getReport($this->yesterdayDate(), $this->yesterdayDate() );
    }

    public function todayDate()
    {
        return Carbon::today()->toDateString();
    }

    public function yesterdayDate()
    {
        return Carbon::yesterday()->toDateString();
    }

}