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
    public function deleteEvento($ev)
    {
        return $this->getResource('Eventi')->deleteEvento($ev);
    }
    public function modificaEvento($data,$key)
    {
    	return $this->getResource('Eventi')->modificaEvento($data,$key);
    }
    public function getEventoById($key)
    {
    	return $this->getResource('Eventi')->getEventoById($key);
    }
    public function getAcquisti()
    {
        return $this->getResource('Acquisti')->getAcquisti();
    }
    public function getUtenti()
    {
        return $this->getResource('Utenti')->getUtenti();
    }
    public function getEventiPart($org,$paged=null)
    {
        return $this->getResource('Eventi')->getEventiPart($org,$paged);
    }
    public function calcolaIncasso($org,$datastart,$dataend)
    {
        return $this->getResource('Eventi')->calcolaIncasso($org,$datastart,$dataend);
    }
}