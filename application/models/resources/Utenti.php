<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name     = 'utenti';
    protected $_primary  = 'username';
    protected $_rowClass = 'Application_Resource_Utenti_Item';
    
    public function init ()       
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('username = ?', $key));
    }
    
    public function getTable($paged=null)
    {
        
        
    }
    
    public function addElement($el)
    {
        $this->insert($el);
    }
    
    public function deleteElement ($key)
    {
        return $this->delete('username =' . $key.'"');
    }
    
    
    
}