<?php
class Application_Form_Public_Ricerca extends Zend_Form
{            
    protected $_publicModel;
    
    public function init()
    {
        $this->setMethod('post');
        $this->setName('Cerca');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->_publicModel = new Application_Model_Public();
        
        $this->addElement('text', 'nome', array(
            'label' => 'Ricerca Evento',
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $categories = array();
	$cats = $this->_publicModel->getTipoEventi($key);
	foreach ($cats as $cat) {
		$categories[$cat->tipologia] = $cat->tipologia;
	}
        $this->addElement('multiCheckbox', 'tipologia', array(
            'label' => 'Tipologia',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $categories
		));
        
        $aziende = array();
	$azi = $this->_publicModel->getEventi($key);
	foreach ($azi as $a) {
		$aziende[$a->nome] = $a->nome;
	}
        $this->addElement('multiCheckbox', 'organizzatore', array(
            'label' => 'Organizzatori',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $aziende
		));
        
        $this->addElement('submit', 'riceroff', array(
            'label' => 'Cerca',
		));
    }
}

