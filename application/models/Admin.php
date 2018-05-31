<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getTipoEventi()
    {
	return $this->getResource('Tipoeventi')->getTipoEventi();
    }
    
    public function saveProduct($info)
    {
    	return $this->getResource('Eventi')->insertProduct($info);
    }
    
    public function getUtente($info)//user by name
    {
    	return $this->getResource('Utenti')->getUtente($info);
    }
    public function getadmUtenti()
    {
        return $this->getResource('Utenti')->getadmUtenti();
    }
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }

}