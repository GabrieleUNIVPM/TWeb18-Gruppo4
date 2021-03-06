<?php
class Application_Form_Admin_Modpartner extends App_Form_Abstract
{
	protected $_adminModel;

        public function init()
    {
    	$this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('modpartner');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        
    }
    public function setValuesPart($part){
        $this->addElement('hidden', 'id_O', array(
            'value' =>$part['id_O']
		));
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'value' => $part['nome'],
            'attribs' => array('readonly' => 'true'),
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('textarea', 'missione', array(
            'label' => 'Missione',
            'value' => $part['missione'],
            'cols' => '22', 'rows' => '7',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'value' => $part['descrizione'],
            'cols' => '22', 'rows' => '7',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'recapiti', array(
            'label' => 'Recapiti',
            'value' => $part['recapiti'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
         $this->addElement('file', 'immagine', array(
        	'label' => 'Logo',
                'value' => $part['immagine'],
        	'destination' => APPLICATION_PATH . '/../public/images',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 1024000),
        			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
        			));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
    public function setValuesUser($u){
        $this->addElement('hidden', 'id_U', array(
            'value' =>$u['id_U']
		));
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'value' => $u['email'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'value' => $u['username'],
            'attribs' => array('readonly' => 'true'),
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
        $this->addElement('submit', 'modpartner', array(
            'label' => 'Conferma',
            'decorators' => $this->buttonDecorators,
        ));
        

    }
}
