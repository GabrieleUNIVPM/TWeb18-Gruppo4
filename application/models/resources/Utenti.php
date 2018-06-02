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
    
    public function getUtenti()
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function salvaUtente($el)
    {
        $this->insert($el);
    }
    
    public function cancellaUtente ($id)
    {
        $where=$this->getAdapter()->quoteInto('id_U=?', $id);
    	return $this->delete($where);
    }
    
    public function modificaUtente ($data, $key)
    {
        $where = $this->getAdapter()->quoteInto('id_U = ?', $key);
        return $this->update($data, $where);
    }
    
}