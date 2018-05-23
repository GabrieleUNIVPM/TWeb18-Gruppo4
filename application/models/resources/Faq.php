<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name     = 'faq';
    protected $_primary  = 'id_F';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
    public function init ()
    {
        
    }
    
    public function getFaqByID($key)
    {
        return $this->fetchRow($this->select()->where('id_F = ?', $key));
    }
    
    public function getFaq()
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function deleteElement($key)
    {
        return $this->delete("id_F = '" . $key . "'");
    }
    
    public function addElement($el)
    {
    	return $this->insert($el);
    }
    
}