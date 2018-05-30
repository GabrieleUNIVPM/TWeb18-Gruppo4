<?php

class Application_Resource_Eventi extends Zend_Db_Table_Abstract
{
    protected $_name     = 'eventi';
    protected $_primary  = 'id_E';
    protected $_rowClass = 'Application_Resource_Eventi_Item';
    
    public function init ()
    {
        
    }
    public function getEventi($key,$paged=null)
    {
        $select = $this->select();
        				//->where('catId IN(?)', $categoryId);
        //if (true === is_array($order)) {
        //    $select->order($order);
        //}
		if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
    
    public function insertProduct($info)
    {
    	$this->insert($info);
    }
    public function insertNome($nome,$id)
    {
        $a=array('organizzatore'=>$nome);
        $where=$this->getAdapter()->quoteInto('id_E=?', $id);
        return $this->update($a,$where);
    }
}