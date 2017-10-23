<?php
namespace Italia\SDK18App\Responses;

use Exception;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class CheckResponse
{
    /**
     * for older php
     * @var string
     */
    const CLASSNAME = __CLASS__;
    /**
     *
     * @var string
     */
    protected $nominativoBeneficiario;
    
    /**
     *
     * @var string
     */
    protected $partitaIvaEsercente;
    
    /**
     *
     * @var string
     */
    protected $ambito;
    
    /**
     *
     * @var string
     */
    protected $bene;
    
    /**
     *
     * @var float
     */
    protected $importo;
    
    /**
     *
     * @param string $nominativoBeneficiario
     * @param string $partitaIvaEsercente
     * @param string $ambito
     * @param string $bene
     * @param double $importo
     */
    public function __construct($nominativoBeneficiario, $partitaIvaEsercente, $ambito, $bene, $importo)
    {
        $this->nominativoBeneficiario = $nominativoBeneficiario;
        $this->partitaIvaEsercente = $partitaIvaEsercente;
        $this->ambito = $ambito;
        $this->bene = $bene;
        $this->importo = $importo;
    }
    
    /**
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'checkResp') {
            $this->nominativoBeneficiario = $value->nominativoBeneficiario;
            $this->partitaIvaEsercente = $value->partitaIvaEsercente;
            $this->ambito = $value->ambito;
            $this->bene = $value->bene;
            $this->importo = $value->importo;
            return;
        }
        
        throw new Exception('Non si setta nulla qua se non lo dico io');
    }
    
    /**
     *
     * @return string
     */
    public function getNominativoBeneficiario()
    {
        return $this->nominativoBeneficiario;
    }
    
    /**
     *
     * @return string
     */
    public function getPartitaIvaEsercente()
    {
        return $this->partitaIvaEsercente;
    }
    
    /**
     *
     * @return string
     */
    public function getAmbito()
    {
        return $this->ambito;
    }
    
    /**
     *
     * @return string
     */
    public function getBene()
    {
        return $this->bene;
    }
    
    /**
     *
     * @return number
     */
    public function getImporto()
    {
        return $this->importo;
    }
    
    /**
     *
     * @param string $nominativoBeneficiario
     * @return CheckResponse
     */
    public function setNominativoBeneficiario($nominativoBeneficiario)
    {
        $this->nominativoBeneficiario = $nominativoBeneficiario;
        return $this;
    }
    
    /**
     *
     * @param string $partitaIvaEsercente
     * @return CheckResponse
     */
    public function setPartitaIvaEsercente($partitaIvaEsercente)
    {
        $this->partitaIvaEsercente = $partitaIvaEsercente;
        return $this;
    }
    
    /**
     *
     * @param string $ambito
     * @return CheckResponse
     */
    public function setAmbito($ambito)
    {
        $this->ambito = $ambito;
        return $this;
    }
    
    /**
     *
     * @param string $bene
     * @return CheckResponse
     */
    public function setBene($bene)
    {
        $this->bene = $bene;
        return $this;
    }
    
    /**
     *
     * @param number $importo
     * @return CheckResponse
     */
    public function setImporto($importo)
    {
        $this->importo = $importo;
        return $this;
    }
}
