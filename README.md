# Fio Bank PHP API Wrapper 

! in development 

Get Fio Bank transaction reports by date in json.

## Create a token

Log in to your Fio admin area:
Settings > API > Add new token.

## :rocket: Installation using Composer

```sh
composer require matusstafura/fioapi
```

## Laravel

config file
```shell
php artisan vendor:publish --tag="fio-report"
```

Add token in .env
```shell
FIO_TOKEN = "your_api_token"
```

## :eyes: Quick view

```php
<?php

use Matusstafura\FioApi\FioReport;

FioReport::yesterday()->getReport();
// will return transaction from previous day

FioReport::today()->getReport();
// will return today's transactions

FioReport::betweenDates("2022-02-14", "2022-02-18")->getReport();
// will return transactions between dates in format YYYY-MM-DD

```

## License

This project is open-sourced software licensed under the MIT license.