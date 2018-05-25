<?php
class Application_Form_Admin_Product_Add extends App_Form_Abstract
{
	protected $_adminModel;
    
    public function init()
    {
    	$this->_adminModel = new Application_Model_Admin();
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
        $tip = $this->_adminModel->getTipoEventi();
        foreach ($tip as $cat) {
        	$tipologia[$cat -> id_TE] = $cat->tipologia;       
        }
        
        $this->addElement('select', 'id_TE', array(
            'label' => 'Categoria',
            'required' => true,
            'multiOptions' => $tipologia,
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'data', array(
            'label' => 'Data',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'orario', array(
            'label' => 'Orario',
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
            'label' => 'Biglietti disponibili',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('text', 'prezzo', array(
            'label' => 'Prezzo biglietto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('textarea', 'programma', array(
            'label' => 'Descrizione Estesa',
        	'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        
        
/*
        $this->addElement('file', 'image', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/images/products',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'gif'))),
            'decorators' => $this->fileDecorators,
        			));
               
        $this->addElement('text', 'descShort', array(
            'label' => 'Descrizione Breve',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('text', 'price', array(
            'label' => 'Prezzo',
            'required' => true,
            'filters' => array('LocalizedToNormalized'),
            'validators' => array(array('Float', true, array('locale' => 'en_US'))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'discountPerc',array(
            'label' => 'Sconto (%)',
            'value' => 0,
            'required' => true,
            'validators' => array('Int'),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('select', 'discounted', array(
            'label' => 'In Sconto',
            'multiOptions' => array('1' => 'Si', '0' => 'No'),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('textarea', 'descLong', array(
            'label' => 'Descrizione Estesa',
        	'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));*/

        $this->addElement('submit', 'add', array(
            'label' => 'Aggiungi Evento',
        	'decorators' => $this->buttonDecorators,
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}