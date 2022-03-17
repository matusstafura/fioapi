<?php

use Illuminate\Support\Facades\Http;
use Matusstafura\FioApi\Facades\FioReport;
use function Spatie\PestPluginTestTime\testTime;

it('checks for if response is ok', function () {
    Http::fake([
        '*' => Http::response('',200)
    ]);
    $response = Http::get('fio.cz')->status();
    expect($response)->toBe(200);
});

it('throws exception if status not 200', function () {
    Http::fake([
        '*' => Http::response('',409)
    ]);
    FioReport::betweenDates("2022-03-11","2022-03-11")->getReport();
})->throws(Exception::class);

it('throws exception if incorrect date', function () {
    Http::fake([
        '*' => Http::response('',200)
    ]);
    FioReport::betweenDates("2000-77-22","2022-03-11")->getReport();
})->throws(Exception::class);

it('gets today\'s date', function () {
    testTime()->freeze('2022-03-11 12:34:56');
    $todayDate = FioReport::todayDate();

    expect($todayDate)->toBe('2022-03-11');
});
