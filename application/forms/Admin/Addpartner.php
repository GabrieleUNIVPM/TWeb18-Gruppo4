<?php
class Application_Form_Admin_Addpartner extends App_Form_Abstract
{
	protected $_adminModel;

        public function init()
    {
    	$this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('addpartner');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('text', 'missione', array(
            'label' => 'Missione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
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
        $this->addElement('text', 'recapiti', array(
            'label' => 'Recapiti',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        /* $this->addElement('file', 'logo', array(
        	'label' => 'Logo',
        	'destination' => APPLICATION_PATH . '/../public/images',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 1024000),
        			array('Extension', false, array('jpg', 'gif'))),
            'decorators' => $this->fileDecorators,
        			));*/
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(3,15)),
                array('Db_NoRecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'username'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(3,15))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'add', array(
            'label' => 'Aggiungi Partner',
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
