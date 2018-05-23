<?php

class PublicController extends Zend_Controller_Action
{
    protected $_publicModel;
    protected $_form;
    protected $_form1;
    //protected $_logger;

    public function init()
    {
        $this->_publicModel = new Application_Model_Public();
        $this->_helper->layout->setLayout('layout');    
    }

    public function indexAction()
    {
        $key= $this->_getParam('getTipoEventi', null);
        $keys=$this->_publicModel->getTipoEventi($key);
        foreach ($keys as $key) {$keys[] = $key->id_TE;}
        $this->view->assign(array(
            		'tipologie' => $keys,
            		)
        );
    }
    
    public function viewstaticAction() {
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }
    
    public function faqAction()
    {
        //$key= $this->_getParam('getFaq', null);
        $faqs=$this->_publicModel->getFaq();
        //foreach ($keys as $key) {$keys[] = $key->id_F;}
        $this->view->assign(array(
            		'FAQ' => $faqs,
            		)
        );
    }

}
