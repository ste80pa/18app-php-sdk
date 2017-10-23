<?php
namespace Italia\SDK18App\Requests;

use Exception;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class ConfirmRequest
{

    /**
     * Se tipo operazione verrà valorizzato con “1”, il check del voucher restituerà all’esercente i campi previsti in output senza consumare il voucher e quindi senza scalare l’importo dal borsellino del beneficiario.
     * Questa modalità di utilizzo dell’operazione non è obbligatoria, ma lascia all’esercente la possibilità di eseguire un controllo tra il nominativo del beneficiario e quello del suo cliente in sessione.
     *
     * @var integer
     */
    const VERIFY = 0x01;

    /**
     * Se tipo operazione verrà valorizzato con “2”, il check del voucher consumerà direttamente l’importo, scalandolo dal borsellino del beneficiario, e restituerà comunque le informazioni previste in output.
     * L’esercente potrà scegliere di usare direttamente questa modalità oppure effettuare due chiamate successive: la prima per il controllo del beneficiario e la seconda per l’effettivo utilizzo del voucher.
     *
     * @var integer
     */
    const CONSUME = 0x02;

    /**
     * CheckRequest::VERIFY or CheckRequest::CHECKOUT
     *
     * @var integer
     */
    protected $tipoOperazione = self::VERIFY;

    /**
     *
     * @var string
     */
    protected $codiceVoucher = '11aa22bb';

    /**
     *
     * @var double
     */
    protected $importo = null;

    /**
     *
     * @param integer $tipoOperazione
     *            CheckRequest::VERIFY or CheckRequest::CHECKOUT
     * @param string $codiceVoucher
     * @param double $importo
     */
    public function __construct($tipoOperazione, $codiceVoucher, $importo = null)
    {
        $this->tipoOperazione = $tipoOperazione;
        $this->codiceVoucher = $codiceVoucher;
        $this->importo = $importo;
    }

    public function check()
    {
        switch ($this->tipoOperazione) {
            case self::VERIFY:
            case self::CONSUME:
                break;
            default:
                throw new Exception('Invalid code provided');
        }
    }

    /**
     *
     * @return \stdClass[]
     */
    public function encode()
    {
        $checkReq = new \stdClass();
        $checkReq->checkReq = array(
            'tipoOperazione' => $this->tipoOperazione,
            'codiceVoucher' => $this->codiceVoucher,
            'importo' => $this->importo
        );
        return array(
            '0' => $checkReq
        );
    }

    /**
     *
     * @return integer
     */
    public function getTipoOperazione()
    {
        return $this->tipoOperazione;
    }

    /**
     *
     * @return string
     */
    public function getCodiceVoucher()
    {
        return $this->codiceVoucher;
    }

    /**
     *
     * @return double
     */
    public function getImporto()
    {
        return $this->importo;
    }

    /**
     *
     * @param integer $tipoOperazione
     * @return \Italia\SDK18App\Requests\ConfirmRequest
     */
    public function setTipoOperazione($tipoOperazione)
    {
        $this->tipoOperazione = $tipoOperazione;
        return $this;
    }

    /**
     *
     * @param string $codiceVoucher
     * @return \Italia\SDK18App\Requests\ConfirmRequest
     */
    public function setCodiceVoucher($codiceVoucher)
    {
        $this->codiceVoucher = $codiceVoucher;
        return $this;
    }

    /**
     *
     * @param double $importo
     * @return \Italia\SDK18App\Requests\ConfirmRequest
     */
    public function setImporto($importo)
    {
        $this->importo = $importo;
        return $this;
    }
}