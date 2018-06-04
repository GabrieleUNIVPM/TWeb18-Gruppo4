<?php

class Application_Form_Public_Acquisto extends App_Form_Abstract
{
    
    protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('acquisto');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        $num=array('0','1','2','3');
        $this->addElement('select', 'numerobiglietti', array(
            'label' => 'Numero biglietti',
            'required' => true,
            'multiOptions' => $num,
            'values'=>$num,
            'decorators' => $this->elementDecorators,
        ));
        $pag=array('Mastercard'=>'M','Visa'=>'V','Bonifico'=>'B');
        $this->addElement('select', 'metodo', array(
            'label' => 'Metodo di pagamento',
            'required' => true,
            'multiOptions' => $pag,
            'values'=>$pag,
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('hidden', 'username', array(
            'value' => $this->user
		));
        $this->addElement('submit', 'add', array(
            'label' => 'Acquista',
            'decorators' => $this->buttonDecorators,
		));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
        		array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}