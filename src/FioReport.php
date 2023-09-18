<?php

declare(strict_types=1);

namespace Matusstafura\FioApi;

use Carbon\Carbon;

class FioReport
{
    public function __construct(protected ApiService $ApiService, protected HttpClient $HttpClient)
    {
    }

    public function getReport(string $date_from, string $date_to): array
    {
        $url = $this->getTransactionsUrl($date_from, $date_to);
        return $this->HttpClient->get($url);
    }

    public function getTransactionsUrl(string $date_from, string $date_to): string
    {
        $date_from = Carbon::parse($date_from)->format('Y-m-d');
        $date_to = Carbon::parse($date_to)->format('Y-m-d');
        return $this->ApiService->baseUrl()."/${date_from}/${date_to}/transactions.json";
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
