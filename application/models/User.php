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
    public function getEventi()
    {
        return $this->getResource('Eventi')->getEventi();
    }
    
    public function getEvento($key)
    {
        return $this->getResource('Eventi')->getEventoByID($key);
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
    
    public function modificaUtente($utente, $key)
    {
        return $this->getResource('Utenti')->modificaUtente($utente, $key);
    }
    public function addPartecipazione($info)
    {
        return $this->getResource('Partecipazioni')->addPartecipazione($info);
    }
    
    public function getEventiAttivi($paged=null){
        return $this->getResource('Eventi')->getEventiAttivi($paged);
    }
    
}