<?php
class Application_Model_User extends App_Model_Abstract
{
    public function __construct()
    {
        //$this->_logger = Zend_Registry::get('log');  	
    }
    
    public function getTipoEventi($key)
    {
	return $this->getResource('Tipoeventi')->getTipoEventi($key);
    }
    public function getEventi($key)
    {
        return $this->getResource('Eventi')->getEventi($key);
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
    
    public function getAcquisti()
    {     
        return $this->getResource('Acquisti')->getAcquisti();
    }
    
     public function getUtente($utente)
    {     
        return $this->getResource('Utenti')->getUtente($utente);
    }
    
    public function salvaUtente($utente)
    {
        return $this->getResource('Utenti')->salvaUtente($utente);
    }
    
    public function cancellaUtente($utente)
    {
        return $this->getResource('Utenti')->cancellaUtente($utente);
    }
    
}