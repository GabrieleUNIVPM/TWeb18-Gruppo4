<?php

class Application_Resource_Partecipazioni extends Zend_Db_Table_Abstract
{
    protected $_name     = 'partecipazioni';
    protected $_primary  = 'id_P';
    protected $_rowClass = 'Application_Resource_Partecipazioni_Item';
    
    public function init ()
    {
        
    }
}