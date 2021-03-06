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
    public function getUtenti()
    {
        return $this->getResource('Utenti')->getUtenti();
    }
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
    public function cancellaUtente($u)
    {
        return $this->getResource('Utenti')->cancellaUtente($u);
    }
    public function savePartner($u)
    {
        return $this->getResource('Organizzazioni')->savePartner($u);
    }
    public function salvaUtente($utente)
    {
        return $this->getResource('Utenti')->salvaUtente($utente);
    }
    public function deleteFaq($f)
    {
        return $this->getResource('Faq')->deleteFaq($f);
    }
     public function addFaq($f)
    {
        return $this->getResource('Faq')->addFaq($f);
    }
    public function addTipev($t)
    {
        return $this->getResource('Tipoeventi')->addTipev($t);
    }
    public function deleteTipev($t)
    {
        return $this->getResource('Tipoeventi')->deleteTipev($t);
    }
    
     public function getFaqByID($id)
    {
        return $this->getResource('Faq')->getFaqByID($id);
    }

    public function modificaFaq($faq, $key)
    {
        return $this->getResource('Faq')->modificaFaq($faq, $key);
    }
    
    public function modificaTipologia($tipo, $key)
    {
        return $this->getResource('Tipoeventi')->modificaTipologia($tipo, $key);
    }
    
    public function getTipoEvento($key)
    {
	return $this->getResource('Tipoeventi')->getTipoEvento($key);
    }
    public function modificaUtente($utente, $key)
    {
        return $this->getResource('Utenti')->modificaUtente($utente, $key);
    }
    public function getAcquisti()
    {
        return $this->getResource('Acquisti')->getAcquisti();
    }
    public function cancellaPartner($p)
    {
        return $this->getResource('Organizzazioni')->cancellaPartner($p);
    }
     public function getPartner($nome)
    {
        return $this->getResource('Organizzazioni')->getPartner($nome);
    }
    public function modificaPartner($data,$id_O)
    {
        return $this->getResource('Organizzazioni')->modificaPartner($data,$id_O);
    }
    
}