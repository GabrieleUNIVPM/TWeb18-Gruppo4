<?php

class IndexController extends Zend_Controller_Action
{
    protected $_publicModel;
    protected $_form;
    protected $_form1;
    // protected $_logger;

    public function init()
    {
       // $this->_publicModel = new Application_Model_Public();  // model da fare
        $this->_helper->layout->setLayout('main');    
    }

    public function indexAction()
    {

    }
    
    public function viewstaticAction() {
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }


}

