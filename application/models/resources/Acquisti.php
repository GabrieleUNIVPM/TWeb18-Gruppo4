<?php

class Application_Resource_Acquisti extends Zend_Db_Table_Abstract
{
    protected $_name     = 'acquisti';
    protected $_primary  = 'id_A';
    protected $_rowClass = 'Application_Resource_Acquisti_Item';
    
    public function init ()
    {
        
    }
    
    public function getAcquisti()
    {
        $select = $this->select();//->where('nomeevento IN(?)', $key);
        return $this->fetchAll($select);
    }
    
}