<?php
class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
		//$this->_logger = Zend_Registry::get('log');  	
	}

    public function getTipoEventi()
    {
	return $this->getResource('Tipoeventi')->getTipoEventi();
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
       
    public function getOrganizzazioni()
    {
        return $this->getResource('Organizzazioni')->getOrganizzazioni();
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
    public function getEventiCercati($type, $nome, $part /*$paged=null*/)
    {
        return $this->getResource('Eventi')->getEventiCercati($type, $nome, $part/* $paged*/);
    }
     public function salvaAcquisto($a)
    {
        return $this->getResource('Acquisti')->salvaAcquisto($a);
    }
    public function getRegioni()
    {
        return $this->getResource('Regioni')->getRegioni();
    }
    public function getProvince($key)
    {
        return $this->getResource('Province')->getProvince($key);
    }
    public function getComuni($key)
    {
        return $this->getResource('Comuni')->getProvince($key);
    }
}