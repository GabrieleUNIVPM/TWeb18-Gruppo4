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
    
    public function deleteFaq($f)
    {
        $where=$this->getAdapter()->quoteInto('id_F=?', $f);
    	return $this->delete($where);
    }
    
    public function addFaq($f)
    {
    	return $this->insert($f);
    }
    
    public function modificaFaq ($data, $key)
    {
        $where = $this->getAdapter()->quoteInto('id_F = ?', $key);
        return $this->update($data, $where);
    }
}