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
    
     public function deleteEvento($ev)//
    {
        $where=$this->getAdapter()->quoteInto('id_E=?', $ev);
    	return $this->delete($where);
    }
    
    public function insertNome($nome,$id)
    {
        $a=array('organizzatore'=>$nome);
        $where=$this->getAdapter()->quoteInto('id_E=?', $id);
        return $this->update($a,$where);
    }
    
    public function getEventiCercati($type, $nome, $part, $paged=null)
    {
        $date = new Zend_Date();
        if(count($type)==0){$string1=("tipologia like '%'");} //se l'utente non ha selezionato nessuna tipologia vanno bene tutte
        else{
            $string1=("tipologia = ''");
            foreach ($type as $c) {$string1.=" or tipologia = '".$c."' ";}
            }
        $string2=("descrizione like '%'");
              foreach ($nome as $d) {$string2.=" and descrizione like '%".$d."%' ";}
        if(count($part)==0){$string3=("organizzatore like '%'");} //se l'utente non ha selezionato nessun organizzatore vanno bene tutte
        else{
            $string3=("organizzatore = ''");
            foreach ($part as $a) {$string3.=" or organizzatore = '".$a."' ";}
            }
        $select=$this->select()->where($string1)
                               ->where($string2)
                               ->where($string3)
                               ->where("'".$date->get('YYYY-MM-dd')."' <= data");
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
                        $paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
}
