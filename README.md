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
**NB: If you are using Laravel with a version greater than '5.5' you can skip this**

Add the following to your '**config/app.php**' file in the '**providers**' array section

```
Delakanda\Mazzuma\MazzumaServiceProvider::class,
```

### Setup the Facade
**NB: If you are using Laravel with a version greater than '5.5' you can skip this**

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
To perform a mobile money transaction, simple '**make**' a Mazzuma instance and call the "**mobileMoney()**" function on the instance. This will return a Mobile Money instance with which you can set the appropriate properties before making a transaction call.

Usage is as follows:


**For Laravel Users:**

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$mobileMoney = Mazzuma::make()->mobileMoney()
  ->price(200)
  ->network("mtn")
  ->recipientNumber("0244000000")
  ->sender("0245000000")
  ->option("rmtm")
  ->orderId("10000010") // Optional 
  ->token("200394903"); // Required ONLY for VODAFONE transactions

// Initiate MoMo Transaction
$transactionResult = $mobileMoney->initiateTransaction();

// To Check status of the mobile money transaction
$transactionStatus = $mobileMoney->checkTransactionStatus();

```

You can also access the Mazzuma object using the mazzuma facade

```php

<?php

use Delakanda\Mazzuma\Facades\Mazzuma;

$mobileMoney = Mazzuma::mobileMoney()
  ->price(200)
  ->network("mtn")
  ->recipientNumber("0244000000")
  ->sender("0245000000")
  ->option("rmtm")
  ->orderId("10000010") // Optional 
  ->token("200394903"); // Required ONLY for VODAFONE transactions

// Initiate MoMo Transaction
$transactionResult = $mobileMoney->initiateTransaction();

// To Check status of the mobile money transaction
$transactionStatus = $mobileMoney->checkTransactionStatus();

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

$mobileMoney = Mazzuma::make($configuration)->mobileMoney()
  ->price(200)
  ->network("mtn")
  ->recipientNumber("0244000000")
  ->sender("0245000000")
  ->option("rmtm")
  ->orderId("10000010") // Optional 
  ->token("200394903"); // Required ONLY for VODAFONE transactions

// Initiate MoMo Transaction
$transactionResult = $mobileMoney->initiateTransaction();

// To Check status of the mobile money transaction
$transactionStatus = $mobileMoney->checkTransactionStatus();

```

**NB: The response from the above code is in JSON with the appropriate http status code as is received from the Mazzuma API itself**

### MAZ Token API

To perform a mazzuma toke API transaction, the process is very similar to that of the mobile money example. Just "**make**" a Mazzuma instance and call the "**mazzumaToken()** function on the instance.

Below is an example of its usage:

#### Send Mazzuma Tokens

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$sendMazzumaToken = Mazzuma::make()->mazzumaToken()
  ->price(200) // The amount to be sent
  ->recipient('delakanda') // This is the unique username of the recipient of the transaction.
  ->sender('dkanda') // This is the unique username of the sender of the transaction.
  ->sendToken();

```

#### Receive Mazzuma Tokens

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$receiveMazzumaToken = Mazzuma::make()->mazzumaToken()
  ->sender('delakanda') // The account making the payment
  ->callback_url('https://your-callback-url.com/path') // Your callback URL
  ->receiveToken();

```

#### Checking Transaction Status

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$transactionStatus = Mazzuma::make()->mazzumaToken()
  ->transactionHash('d5b3ea3a7565383d6124f5ba1eeec0be') // The hash of the transaction you want to check.
  ->checkTransactionStatus();

```

#### Get Account Balance

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$accountBalance = Mazzuma::make()->mazzumaToken()
  ->getAccountBalance();

```

#### Validate Account

```php

<?php

use Delakanda\Mazzuma\Mazzuma;

$accountValidationStatus = Mazzuma::make()->mazzumaToken()
  ->username("delakanda")
  ->validateAccount();

```

**NOTE:** For the Mazzuma token API examples above, if you aren't using laravel, you have to create a **config** instance and pass that to the **make** function of the Mazzuma class. check the mobile money section for example usage.