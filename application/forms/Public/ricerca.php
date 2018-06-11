<?php
class Application_Form_Public_Ricerca extends App_Form_Abstract
{protected $_publicModel;
    
    public function init()
    {
        $this->setMethod('post');
        $this->setName('Cerca');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->_publicModel = new Application_Model_Public();
        
        $this->addElement('text', 'nome', array(
            'label' => 'Ricerca Evento',
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,25))),
    ));
        
        $categories = array();
  $cats = $this->_publicModel->getTipoEventi();
  foreach ($cats as $cat) {
    $categories[$cat->tipologia] = $cat->tipologia;
  }
        $this->addElement('multiCheckbox', 'tipologia', array(
            'label' => 'Tipologie',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $categories
    ));
        
        $part = array();
  $par = $this->_publicModel->getOrganizzazioni();
  foreach ($par as $p) {
    $part[$p->nome] = $p->nome;
  }
        $this->addElement('multiCheckbox', 'organizzatore', array(
            'label' => 'Organizzatori',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $part
    ));
        $this->addElement('select', 'data', array(
            'label' => 'Mese',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => array(
                         'null' => '->Seleziona<-',
                         '01' => 'Gennaio',
                         '02' => 'Febbraio',
                         '03' => 'Marzo',
                         '04' => 'Aprile',
                         '05' => 'Maggio',
                         '06' => 'Giugno',
                         '07' => 'Luglio',
                         '08' => 'Agosto',
                         '09' => 'Settembre',
                         '10' => 'Ottobre',
                         '11' => 'Novembre',
                         '12' => 'Dicembre',
                         ),
    ));
        $regs = array();
        $regs=['->Seleziona<-'];
  $reg = $this->_publicModel->getRegioni();
  foreach ($reg as $r) {
    $regs[$r->nome] = $r->nome;
  }
        $this->addElement('select', 'reg', array(
            'label' => 'Regione',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $regs,
    ));
        $this->addElement('hidden', 'id_reg', array(
            //'value' => $regs['id'],
            ));
        
        $provs=array();
        $provs=['->Seleziona<-'];
        /*$prov = $this->_publicModel->getProvince('3');
        foreach ($prov as $p) {
        $provs[$p->nome] = $p->nome;
  }*/
        $this->addElement('select', 'prov', array(
            'label' => 'Provincia',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $provs,
            ));
            
        $this->addElement('hidden', 'id', array(
        //'value' => $provs['id'],
        ));
        
        $cities=array();
        $cities=['->Seleziona<-'];
  /*$city = $this->_publicModel->getComuni('15');
  foreach ($city as $c) {
    $cities[$c->nome] = $c->nome;
  }*/     
        $this->addElement('select', 'city', array(
            'label' => 'Città',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => $cities,
    ));
        
        $this->addElement('submit', 'riceroff', array(
            'label' => 'Cerca',
    ));
    }
}