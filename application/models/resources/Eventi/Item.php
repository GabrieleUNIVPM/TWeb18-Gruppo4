<?php

class Application_Resource_Eventi_Item extends Zend_Db_Table_Row_Abstract
{       
    public function getPrice()
    {
    	$price = $this->prezzo;
    	if (true == $this->isDiscounted()) {
            $discount = $this->sconto;
            $discounted = ($price*$discount)/100;
            $price = round($price - $discounted, 2);
        }
        return $price;
    }
    
    private function isDiscounted()
    {
        if($this->sconto==0) return false;
        else return true;
    }
    public function getNome()
    {
        return $nome=$this->nome;
    }
}