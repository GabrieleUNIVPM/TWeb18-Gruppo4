<?php

class Application_Resource_Tipoeventi extends Zend_Db_Table_Abstract
{
    protected $_name     = 'tipoeventi';
    protected $_primary  = 'id_TE';
    protected $_rowClass = 'Application_Resource_Tipoeventi_Item';
    
    public function init ()
    {
        
    }
        public function getTipoEventi()
    {
        $select = $this->select()
                       ->order('tipologia');
        return $this->fetchAll($select);
    }
}