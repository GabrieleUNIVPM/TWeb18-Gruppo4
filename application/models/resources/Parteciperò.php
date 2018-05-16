<?php

class Application_Resource_Parteciperò extends Zend_Db_Table_Abstract
{
    protected $_name     = 'parteciperò';
    protected $_primary  = 'id_P';
    protected $_rowClass = 'Application_Resource_Parteciperò_Item';
    
    public function init ()
    {
        
    }
