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
    	return $this->getResource('Product')->insertProduct($info);
    }
    
    public function getUserByName($info)
    {
    	return $this->getResource('User')->getUserByName($info);
    }

}