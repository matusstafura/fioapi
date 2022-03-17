# Fio Bank PHP API Wrapper 

Get Fio Bank transaction reports by date in json.

## Create a token

Log in to your Fio admin area:
Settings > API > Add new token.

## :rocket: Installation using Composer

```sh
composer require matusstafura/fioapi
```

## Laravel

- to publish config file
```shell
php artisan vendor:publish --tag="fio-report"
```

- add token in .env
```shell
FIO_TOKEN = "your_api_token"
```

## :eyes: Quick view

```php
<?php

use Matusstafura\FioApi\Facades\FioReport;

FioReport::yesterday();
// will return transaction from previous day

FioReport::today();
// will return today's transactions

FioReport::betweenDates("2022-02-14", "2022-02-18");
// will return transactions between dates in format YYYY-MM-DD

```

## License

This project is open-sourced software licensed under the MIT license.