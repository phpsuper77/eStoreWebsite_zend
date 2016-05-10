<?php

class Admin_HomeController extends Jaycms_Controller_Action
{                                            

 	public function init()
    {         
        parent::init();
        $user = Utils::adminuser();
        if ( $user == null ) {
            $this->_redirect('/admin');
        }
        $this->view->current_module = "home";
        $this->view->page_title = "HOME";
        $layout = $this->_helper->layout();
        
        $layout->setLayout('/admin/layout-admin');
    }                   
    
    public function indexAction(){    
               
    }         
}
