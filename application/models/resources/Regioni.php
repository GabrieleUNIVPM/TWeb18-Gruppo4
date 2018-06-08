<?php

class Application_Resource_Regioni extends Zend_Db_Table_Abstract
{
    protected $_name     = 'regioni';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Regioni_Item';
    
    public function init ()
    {
        
    }
    
    public function getRegioni()
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
}