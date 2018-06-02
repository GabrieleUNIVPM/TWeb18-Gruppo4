<?php

class Application_Resource_Tipoeventi extends Zend_Db_Table_Abstract
{
    protected $_name     = 'tipoeventi';
    protected $_primary  = 'id_TE';
    protected $_rowClass = 'Application_Resource_Tipoeventi_Item';
    
    public function init ()
    {
        
    }
    
    public function getTipoEvento($key)
    {
         return $this->fetchRow($this->select()->where('id_TE = ?', $key));
    }
    
    public function getTipoEventi()
    {
        $select = $this->select()->order('id_TE');
        return $this->fetchAll($select);
    }
    
    public function addTipev($el)
    {
    	$this->insert($el);
    }
    
    public function deleteTipev($id)
    {
        $where=$this->getAdapter()->quoteInto('id_TE=?', $id);
    	return $this->delete($where);
    }
}
