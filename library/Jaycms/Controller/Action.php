<?php
class Jaycms_Controller_Action extends Zend_Controller_Action
{
	public function init(){

        /*if( !Utils::user() && $this->getRequest()->getControllerName() != 'login' ){
            $this->_redirect('/login');
        }*/
	}

	public function preDispatch(){
        $this->view->user = Utils::user();
	}
	
	public function disableLayout(){
		$this->view->layout()->disableLayout();
	}
	public function disableLayoutAndRender(){
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
	
	public function redirect($url){
		$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
		return $redirector->gotoUrl($url);
	}

	
	
	
}