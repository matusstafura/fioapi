<?php

use Illuminate\Support\Facades\Http;
use Matusstafura\FioApi\FioReport;

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
