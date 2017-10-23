[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)

## Synopsis

This project i part of  Developers Italia initiative.

## Converting the certificate

This library uses client certificate in pem format. To generate a pem format certificate from an existing pkcs12 archive use the following command

```
openssl pkcs12 -in key.p12 -out key.pem -clcerts
```

## Code Example

Invoking the activation procedure

```php
<?php
require_once 'autoload.php';
use Italia\SDK18App\Client;
use Italia\SDK18App\Base\ResponseException;
$certificatePath = implode(DIRECTORY_SEPARATOR, array(
    __DIR__,
    '..',
    'key.pem'
));
$wsdlPath = implode(DIRECTORY_SEPARATOR, array(
    __DIR__,
    '..',
    'VerificaVoucher.wsdl'
));
// create a new instance of the client
$client = new Client($certificatePath, $wsdlPath);
try {
    print_r($client->activate());
} catch (ResponseException $e) {
    // Protocol Exception
    echo $e->getMessage();
} catch (Exception $e) {
    // Other problems occurred
    echo $e->getMessage();
}
```

## Motivation


## Installation

## Tests
To run all tests

```
phpunit
```

## Contributors


## License
