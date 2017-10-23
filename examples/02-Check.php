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
    print_r($client->check(2, 'dfs'));
} catch (ResponseException $e) {
    // Protocol Exception
    echo $e->getMessage();
} catch (Exception $e) {
    // Other problems occurred
    echo $e->getMessage();
}