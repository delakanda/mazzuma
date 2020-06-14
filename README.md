# Mazzuma Laravel Package
A Laravel-first integration for the Mazzuma API. It can also be used with other PHP libraries as well as Vanilla PHP.

It provides an easy to use interface for all you Mazzuma API needs.

## How to install
Installation is as simple as running:

```
$ composer require delakanda/mazzuma
```

## For Laravel users

### Service Provider Setup
** NB: If you are using Laravel with a version greater than '5.5' you can skip this **

Add the following to your '**config/app.php**' file in the '**providers**' array section

```
Delakanda\Mazzuma\MazzumaServiceProvider::class,
```

### Setup the Facade
** NB: If you are using Laravel with a version greater than '5.5' you can skip this **

Add the Mazzuma facade to your '**config/app.php**' file in the '**aliases**' array section

```
'Mazzuma' => Delakanda\Mazzuma\Facades\Mazzuma::class,
```

### Add environment variables to your .env
Add the following to your .env file

```
MAZZUMA_API_KEY=xxxxxxxxxxxxx
```

## Usage

### Mazzuma Mobile Money
To perform a mobile money transaction, simple '**make**' a Mazzuma instance and call the mobile money function on the instance. This will return a Mobile Money instance with which you can set the appropriate properties before making a transaction call.

Usage is as follows:


**For Laravel Users:**

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$transactionResult = Mazzuma::make()->mobileMoney()
  ->price(200);
  ->network("mtn")
  ->recipientNumber("0244000000")
  ->sender("0245000000")
  ->option("rmtm")
  ->orderId("10000010") // Optional 
  ->token(""); // Required ONLY for VODAFONE transactions

```

**For vanilla PHP and other Frameworks:**

```php

<?php

// Required for vanilla PHP, Laravel and other frameworks may handle this already
require_once __DIR__ . '/vendor/autoload.php';

use Delakanda\Mazzuma\Config\Config;
use Delakanda\Mazzuma\Mazzuma;

$apiKey = 'xxxxxxxxx';
$configuration = new Config($apiKey);

$transactionResult = Mazzuma::make($configuration)->mobileMoney()
  ->price(200);
  ->price(200);
  ->network("mtn")
  ->recipientNumber("0244000000")
  ->sender("0245000000")
  ->option("rmtm")
  ->orderId("10000010") // Optional 
  ->token(""); // Required ONLY for VODAFONE transactions

```

** NB: The response from the above code is in JSON with the appropriate http status code as is received from the Mazzuma API itself **