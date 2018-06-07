<?php
class Application_Form_Organizzazioni_Product_Add extends App_Form_Abstract
{
	protected $_organizzazioniModel;

        public function init()
    {
    	$this->_organizzazioniModel = new Application_Model_Organizzazioni();
        $this->setMethod('post');
        $this->setName('addproduct');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->addElement('text', 'nome', array(
            'label' => 'Nome Evento',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        
        $tipologia = array();
        $tip = $this->_organizzazioniModel->getTipoEventi();
        foreach ($tip as $cat) {
        	$tipologia[$cat -> tipologia] = $cat->tipologia;       
        }

        $this->addElement('select', 'tipologia', array(
            'label' => 'Tipologia',
            'required' => true,
            'multiOptions' => $tipologia,
            'values'=>$tipologia,
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'cols' => '22', 'rows' => '7',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'data', array(
            'label' => 'Data (AAAA/MM/GG)',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('yyyy/MM/dd'))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'orario', array(
            'label' => 'Orario (HH:MM)',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('text', 'luogo', array(
            'label' => 'Luogo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('text', 'numerobiglietti', array(
            'label' => 'Numero Biglietti',
            'filters' => array('StringTrim'),
            'required' => false,
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('text', 'prezzo', array(
            'label' => 'Prezzo biglietto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
          $this->addElement('file', 'immagine', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/images',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 1024000),
        			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
        			));
               
        $this->addElement('textarea', 'programma', array(
            'label' => 'Programma',
            'cols' => '22', 'rows' => '7',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('text', 'sconto',array(
            'label' => 'Sconto (%)',
            'value' => 0,
            'required' => true,
            'validators' => array('Int'),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('textarea', 'mappa', array(
            'label' => 'Link Maps',
            'cols' => '22', 'rows' => '3',
            'filters' => array('StringTrim'),
            'required' => false,
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('submit', 'add', array(
            'label' => 'Conferma',
            'decorators' => $this->buttonDecorators,
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        $this->addElement('hidden', 'organizzatore', array(
            'value' => $this->nome
		));
    }
}
