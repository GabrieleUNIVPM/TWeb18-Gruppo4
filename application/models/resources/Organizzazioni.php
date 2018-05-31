<?php

class Application_Resource_Organizzazioni extends Zend_Db_Table_Abstract
{
    protected $_name     = 'organizzazioni';
    protected $_primary  = 'id_O';
    protected $_rowClass = 'Application_Resource_Organizzazioni_Item';
    
    public function init ()
    {
        
    }
    public function getOrganizzazioni()
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
}