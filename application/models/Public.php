<?php
class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
		//$this->_logger = Zend_Registry::get('log');  	
	}

    public function getTipoEventi($key)
    {
		return $this->getResource('Tipoeventi')->getTipoEventi($key);
    }
    public function getEventi()
    {
        return $this->getResource('Eventi')->getEventi();
    }

    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
       
    public function getOrganizzazioni()
    {
        return $this->getResource('Organizzazioni')->getOrganizzazioni();
    }    
    
    public function getPartecipazioni()
    {     
        return $this->getResource('Partecipazioni')->getPartecipazioni();
    }
    
    public function getAcquisti()
    {     
        return $this->getResource('Acquisti')->getAcquisti();
    }
    
     public function getUtenti()
    {     
        return $this->getResource('Utenti')->getUtenti();
    }
    
}