<?php

declare(strict_types=1);

namespace Matusstafura\FioApi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FioReport
{
    public function __construct(protected FioApiService $fioApiService)
    {
    }

    public function getReport(string $date_from, string $date_to): array
    {
        try {
            $date_from = Carbon::parse($date_from)->format('Y-m-d');
            $date_to = Carbon::parse($date_to)->format('Y-m-d');

            $url = $this->fioApiService->baseUrl()."/${date_from}/${date_to}/transactions.json";

            $response = Http::get($url);

            if ($response->status() !== 200) {
                throw new \Exception('Could not connect to a bank.');
            }

            return $response->json();
        } catch (\Exception $e) {
            throw new \Exception('Invalid input date.');
        }
    }

    public function betweenDates(string $date_from, string $date_to): array
    {
        return $this->getReport($date_from, $date_to);
    }

    public function today(): array
    {
        return $this->getReport($this->todayDate(), $this->todayDate());
    }

    public function yesterday(): array
    {
        return $this->getReport($this->yesterdayDate(), $this->yesterdayDate());
    }

    public function todayDate(): string
    {
        return Carbon::today()->toDateString();
    }

    public function yesterdayDate(): string
    {
        return Carbon::yesterday()->toDateString();
    }
}
