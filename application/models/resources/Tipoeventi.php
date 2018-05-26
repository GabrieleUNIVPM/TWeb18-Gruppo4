<?php

class Application_Resource_Tipoeventi extends Zend_Db_Table_Abstract
{
    protected $_name     = 'tipoeventi';
    protected $_primary  = 'id_TE';
    protected $_rowClass = 'Application_Resource_Tipoeventi_Item';
    
    public function init ()
    {
        
    }
    
    public function getTipoEvento()
    {
         return $this->fetchRow($this->select()->where('id_TE = ?', $key));
    }
    
    public function getTipoEventi($key)
    {
        $select = $this->select()->order('id_TE');
        return $this->fetchAll($select);
    }
    
    public function addElement($el)
    {
    	$this->insert($el);
    }
    
    public function deleteElement($key)
    {
        return $this->delete('id_TE = ?', $key);
    }
}
