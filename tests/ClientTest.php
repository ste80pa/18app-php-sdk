<?php
use PHPUnit\Framework\TestCase;
use Italia\SDK18App\Client;
/**
 * 
 * @author Stefano Pallozzi
 *
 */
class ClientTest extends TestCase
{

    /**
     * 
     * @return \Italia\SDK18App\Client
     */
    public function testActivate()
    {
        $wsdl = $GLOBALS['sdk18app_wsdl'];
        $certificatePath = $GLOBALS['sdk18app_key'];
        
        $client = new Client($certificatePath, $wsdl);
        
        $response = $client->activate();
        return $client;
    }

    /**
     * @depends testActivate
     */
    public function testCheck(Client $client)
    {
        $client->check($tipoOperazione, $codiceVoucher);
    }
}
