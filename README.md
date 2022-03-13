# Fio Bank PHP API Wrapper

! in development 

Get Fio Bank transaction reports by date in json.

### Create a token

Log in to your Fio admin area.
Settings > API > Add new token

## :rocket: Installation using Composer

```sh
composer require 
```

## Laravel

import as a facade
```php
use Matusstafura\FioApi\Facades\FioReport;
```

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

FioReport::yesterday();
// will return transaction from previous day

```

## License

This project is open-sourced software licensed under the MIT license.
