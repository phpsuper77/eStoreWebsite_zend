<?php

class IndexController extends Jaycms_Controller_Action
{

 	public function init()
    {
    	parent::init();
    	$this->redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $this->view->current_page = "";
        $this->view->page_title = "MOSTRAR MENU";
        $this->view->user = Utils::user();
    }

    public function indexAction()
    {   
    	//$this->_redirect('/invoices');
    } 
    
    public function myaccountAction()
    {
         $this->view->current_page = "myaccount";
    } 

}

