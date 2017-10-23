<?php
namespace Italia\SDK18App;

use Italia\SDK18App\Requests\CheckRequest;
use Italia\SDK18App\Requests\ConfirmRequest;
use Italia\SDK18App\Responses\CheckResponse;
use SoapClient;
use Italia\SDK18App\Base\ResponseException;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class Client extends SoapClient
{

    /**
     *
     * @var string
     */
    const PRODUCTION = 'production';

    /**
     *
     * @var string
     */
    const SANDBOX = 'sandbox';

    /**
     * Default environment
     *
     * @var string
     */
    protected $environment = self::SANDBOX;

    /**
     * Collection of endpoints for production and sandbox environment
     * 
     * @var array
     */
    protected static $endopoints = array(
        self::SANDBOX => 'https://wstest.18app.italia.it/VerificaVoucherWEB/VerificaVoucher',
        self::PRODUCTION => 'https://ws.18app.italia.it/VerificaVoucherWEB/VerificaVoucher'
    );

    /**
     *
     * @param string $certificatePath
     *            Relative or absolute path for client certificate in PEM format
     * @param string $wsdl
     *            Relative or absolute path for WSDL
     * @param array $options
     *            same options of <a href="http://php.net/manual/it/soapclient.soapclient.php">SoapClient</a>
     * @param string $environment
     */
    public function __construct($certificatePath, $wsdl, array $options = array(), $environment = self::SANDBOX)
    {
        $this->environment = $environment === self::PRODUCTION ? self::PRODUCTION : self::SANDBOX;
        
        $options['location'] = self::$endopoints[$this->environment];
        $options['local_cert'] = $certificatePath;
        $options['classmap'] = array(
            'CheckResponseObj' => CheckResponse::CLASSNAME
        );
        $options['trace'] = 1;
        $options['exceptions'] = true;
        $options['stream_context'] = stream_context_create(array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        ));
        $options['soap_version'] = SOAP_1_1;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;
        
        parent::__construct($wsdl, $options);
    }

    /**
     * Performs activation procedure
     * 
     * @return mixed
     */
    public function activate()
    {
        return $this->check(CheckRequest::VERIFY, '11aa22bb');
    }

    /**
     *
     * {@inheritdoc}
     * @see SoapClient::__soapCall()
     */
    public function __soapCall($function_name, $arguments, $options = null, $input_headers = null, &$output_headers = null)
    {
        try {
            return parent::__soapCall($function_name, $arguments, $options, $input_headers, $output_headers);
        } catch (\SoapFault $soapFault) {
            throw ResponseException::fromSoapFault($soapFault);
        }
    }

    /**
     *
     * @param integer $tipoOperazione
     * @param string $codiceVoucher
     * @param string $partitaIvaEsercente
     */
    public function check($tipoOperazione, $codiceVoucher, $partitaIvaEsercente = null)
    {
        $request = new CheckRequest($tipoOperazione, $codiceVoucher, $partitaIvaEsercente);
        
        $request->check();
        
        return $this->__soapCall('Check', $request->encode());
    }

    /**
     * 
     * @param integer $tipoOperazione
     * @param string $codiceVoucher
     * @param double $importo
     * @return mixed
     */
    public function confirm($tipoOperazione, $codiceVoucher, $importo)
    {
        $request = new ConfirmRequest($tipoOperazione, $codiceVoucher, $importo);
        
        $request->check();
        
        return $this->__soapCall('Confirm', $request->encode());
    }
}