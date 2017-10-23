<?php
namespace Italia\SDK18App\Responses;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class ConfirmResponse
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
    protected  $esito;
    
    /**
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'checkResp') {
           
            $this->esito = $value->esito;
            return;
        }
        
        throw new \Exception('Non si setta nulla qua se non lo dico io');
    }
    
}