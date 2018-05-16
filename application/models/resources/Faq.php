<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name     = 'faq';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
    public function init ()
    {
        
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('id = ?', $key));
    }
    
    public function getTable($paged=null)
    {
        
    }
    
    public function deleteElement($key)
    {
        return $this->delete("id = '" . $key . "'");
    }
    
    public function addElement($el)
    {
    	return $this->insert($el);
    }
    
}