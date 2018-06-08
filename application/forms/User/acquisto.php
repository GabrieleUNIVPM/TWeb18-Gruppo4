<?php

class Application_Form_User_Acquisto extends App_Form_Abstract
{
    
    protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('acquisto');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        
        
        $num=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
        $this->addElement('select', 'numerobiglietti', array(
            'label' => 'Numero biglietti',
            'required' => true,
            'multiOptions' => $num,
        //    'values'=>'$num',
            'decorators' => $this->elementDecorators,
        ));
        
        
        $pag=array('P'=>'Paypal', 'M'=>'Mastercard','V'=>'Visa','B'=>'Bonifico bancario');
        $this->addElement('select', 'metodo', array(
            'label' => 'Metodo di pagamento',
            'required' => true,
            'multiOptions' => $pag,
            'values'=>$pag,
            'decorators' => $this->elementDecorators,
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
    public function setValues($v,$e){
        $this->addElement('hidden', 'username', array(
            'value' => $v
		));
        $this->addElement('hidden', 'nomeevento', array(
            'value' => $e
		));
    }
} 