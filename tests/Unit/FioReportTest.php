<?php

use Illuminate\Support\Facades\Http;
use Matusstafura\FioApi\Facades\FioReport;
use function Spatie\PestPluginTestTime\testTime;

it('checks for if response is ok', function () {
    Http::fake([
        '*' => Http::response('', 200)
    ]);
    $response = Http::get('fio.cz')->status();
    expect($response)->toBe(200);
});

it('throws exception if status not 200', function () {
    Http::fake([
        '*' => Http::response('', 409)
    ]);
    FioReport::betweenDates("2022-03-11", "2022-03-11")->getReport();
})->throws(Exception::class);

it('throws exception if incorrect date', function () {
    Http::fake([
        '*' => Http::response('', 200)
    ]);
    FioReport::betweenDates("2000-77-22", "2022-03-11")->getReport();
})->throws(Exception::class);

it('gets today\'s date', function () {
    testTime()->freeze('2022-03-11 12:34:56');
    $todayDate = FioReport::todayDate();

    expect($todayDate)->toBe('2022-03-11');
});

it('returns correctly formatted user data', function () {
    $fioReport = $this->createMock(\Matusstafura\FioApi\FioReport::class);
    $fioReport->method('getReport')
        ->with("2022-03-11", "2022-03-11")
        ->willReturn(["accountStatement"=>["info"=>["accountId"=>"123457890","bankId"=>"4444","currency"=>"EUR","iban"=>"SK0000000000000000000000","bic"=>"FIOZSKBAXXX","openingBalance"=>10000000.39,"closingBalance"=>20000000.89,"dateStart"=>"2022-03-11+0100","dateEnd"=>"2022-03-11+0100","yearList"=>null,"idList"=>null,"idFrom"=>11111111111,"idTo"=>22222222222,"idLastDownload"=>null],"transactionList"=>["transaction"=>[["column22"=>["value"=>24066596722,"name"=>"ID pohybu","id"=>22],"column0"=>["value"=>"2022-03-11+0100","name"=>"Datum","id"=>0],"column1"=>["value"=>-25.00,"name"=>"Objem","id"=>1],"column14"=>["value"=>"EUR","name"=>"Měna","id"=>14],"column2"=>["value"=>"SK5555555555555555555555","name"=>"Protiúčet","id"=>2],"column10"=>["value"=>"","name"=>"Název protiúčtu","id"=>10],"column3"=>null,"column12"=>null,"column4"=>["value"=>"0308","name"=>"KS","id"=>4],"column5"=>["value"=>"99999999","name"=>"VS","id"=>5],"column6"=>["value"=>"1200000000","name"=>"SS","id"=>6],"column7"=>["value"=>" ","name"=>"Uživatelská identifikace","id"=>7],"column16"=>["value"=>"Some message","name"=>"Zpráva pro příjemce","id"=>16],"column8"=>["value"=>"Bezhotovostní platba","name"=>"Typ","id"=>8],"column9"=>["value"=>"Tom Smith","name"=>"Provedl","id"=>9],"column18"=>null,"column25"=>["value"=>"Comment about payment","name"=>"Komentář","id"=>25],"column26"=>["value"=>"XXXXSKBXXXX","name"=>"BIC","id"=>26],"column17"=>["value"=>88888888888,"name"=>"ID pokynu","id"=>17],"column27"=>null]]]]]);

    $report = $fioReport->getReport("2022-03-11", "2022-03-11");

    expect($report['accountStatement']['info'])->toMatchArray([
        'accountId' => '123457890',
        'bankId' => 4444,

        'currency' => 'EUR'
    ]);
});
