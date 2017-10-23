<?php
namespace Italia\SDK18App\Base;

class ResponseException extends \Exception
{

    /**
     * Error in the input parameters, check and try again
     */
    const INVALID_INPUT = 0x01;

    /**
     * The requested voucher is not available on the system.
     * It could be already collected or canceled
     */
    const UNAVAILABLE_VAUCHER = 0x02;

    /**
     * Impossible to activate the user.
     * Please verify input parameters and that the user has not been already activated.
     */
    const UNABLE_TO_ACTIVATE_USER = 0x03;

    /**
     * The amount claimed is greater than the amount of the selected voucher
     */
    const INVALID_AMOUNT = 0x04;

    /**
     * User inactive, voucher impossible to verify.
     */
    const INACTIVE_USER = 0x05;

    /**
     * Category and type of this voucher are not aligned with category and type managed by the user.
     */
    const INVALID_TYPE_MATCH = 0x06;

    /**
     *
     * @param \SoapFault $soapException
     */
    public static function fromSoapFault($soapFault)
    {
        if (get_class($soapFault) != 'SoapFault') {
            return $soapFault;
        }
        if (! property_exists($soapFault, 'detail')) {
            return $soapFault;
        }
        
        if (! property_exists($soapFault->detail, 'FaultVoucher')) {
            return $soapFault;
        }
        
        $data = $soapFault->detail->FaultVoucher;
        
        return new ResponseException($data->exceptionMessage, $data->exceptionCode, $soapFault);
    }
}