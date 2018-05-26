<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
	public function init()
    {               
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    	
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array('Alnum',array('StringLength', true, array(3, 25)),
                            array('Db_RecordExists',true,
                            array('table' => 'utenti',
                                  'field' => 'username'))),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array('alnum',array('StringLength', true, array(3, 25)),
                            array('Db_RecordExists',true,
                            array('table' => 'utenti',
                                  'field' => 'username'))),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('submit', 'entra', array(
            'label'    => 'Login',
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
