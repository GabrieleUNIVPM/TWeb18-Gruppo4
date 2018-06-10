<?php

class Application_Resource_Province extends Zend_Db_Table_Abstract
{
    protected $_name     = 'province';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Province_Item';
    
    public function init ()
    {
        
    }
    
    public function getProvince($key)
    {
        $select = $this->select()->where('id_regione IN(?)', $key);
        return $this->fetchAll($select);
    }
}