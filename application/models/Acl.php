<?php

class Application_Model_Acl extends Zend_Acl
{
	public function __construct()
	{
		// ACL for default role
		$this->addRole(new Zend_Acl_Role('unregistered'))
			 ->add(new Zend_Acl_Resource('public'))
			 ->add(new Zend_Acl_Resource('error'))
			 ->allow('unregistered', array('public','error'));
			 
		// ACL for user
		$this->addRole(new Zend_Acl_Role('user'), 'unregistered')
			 ->add(new Zend_Acl_Resource('user'))
			 ->allow('user','user');
				   
		// ACL for partner
		$this->addRole(new Zend_Acl_Role('partner'), 'unregistered')
			 ->add(new Zend_Acl_Resource('partner'))
			 ->allow('partner','partner');
                
                // ACL for admin
		$this->addRole(new Zend_Acl_Role('admin'), 'unregistered')
			 ->add(new Zend_Acl_Resource('admin'))
			 ->allow('admin','admin');
                
	}
}