<?php

class Application_Resource_Eventi extends Zend_Db_Table_Abstract
{
    protected $_name     = 'eventi';
    protected $_primary  = 'id_E';
    protected $_rowClass = 'Application_Resource_Eventi_Item';
    
    public function init ()
    {
        
    }
    public function getEventi($key)
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
    public function insertProduct($info)
    {
    	$this->insert($info);
    }
}