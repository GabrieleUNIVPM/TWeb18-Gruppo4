<?php

class Application_Resource_Comuni extends Zend_Db_Table_Abstract
{
    protected $_name     = 'comuni';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Comuni_Item';
    
    public function init ()
    {
        
    }
    
    public function getComuni($key)
    {
        $select = $this->select()->where('id_provincia IN(?)', $key);
        return $this->fetchAll($select);
    }
}