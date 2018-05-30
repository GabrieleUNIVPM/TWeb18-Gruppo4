<?php

class Application_Model_Organizzazioni extends App_Model_Abstract
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
    public function insertNome($info,$id)
    {
    	return $this->getResource('Eventi')->insertNome($info,$id);
    }
    public function getEventi($key,$paged=null)
    {
        return $this->getResource('Eventi')->getEventi($key,$paged);
    }
}