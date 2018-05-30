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
    public function getEventi($key,$paged=null)
    {
        return $this->getResource('Eventi')->getEventi($key,$paged);
    }
    public function getEvento($key)
    {
        return $this->getResource('Eventi')->getEvento($key);
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
       
    public function getOrganizzazioni($key)
    {
        return $this->getResource('Organizzazioni')->getOrganizzazioni($key);
    }    
    
    public function getPartecipazioni()
    {     
        return $this->getResource('Partecipazioni')->getPartecipazioni();
    }
    
    public function getAcquisti($key)
    {     
        return $this->getResource('Acquisti')->getAcquisti($key);
    }
    
    public function getAcquistiEvento($key)
    {     
        return $this->getResource('Acquisti')->getAcquistiEvento($key);
    }
    
     public function getUtenti()
    {     
        return $this->getResource('Utenti')->getUtenti();
    }
    
    public function salvaUtente($utente)
    {
        return $this->getResource('Utenti')->salvaUtente($utente);
    }
    public function getEventiCercati($type, $name, $part, $paged=null)
    {
        return $this->getResource('Eventi')->getEventiCercati($type, $name, $part, $paged);
    }
}