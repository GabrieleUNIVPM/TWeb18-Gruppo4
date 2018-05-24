<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name     = 'utenti';
    protected $_primary  = 'id_U';
    protected $_rowClass = 'Application_Resource_Utenti_Item';
    
    public function init ()       
    {
    }
    
    public function getUtente($key)
    {
        return $this->fetchRow($this->select()->where('username = ?', $key));
    }
    
    public function getUtenti($paged=null)
    {
        
        
    }
    
    public function salvaUtente($el)
    {
        $this->insert($el);
    }
    
    public function cancellaUtente ($key)
    {
        return $this->delete('username =' . $key.'"');
    }
    
    
    
}