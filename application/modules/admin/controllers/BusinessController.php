<?php

class Admin_BusinessController extends Jaycms_Controller_Action
{                                            

 	public function init()
    {
        parent::init();
        $user = Utils::adminuser();
        if ( $user == null ) {
            $this->_redirect('/admin');
        }       
        
        $this->view->current_module = "business";
        $this->view->page_title = "BUSINESS";
        $layout = $this->_helper->layout();
        $layout->setLayout('/admin/layout-admin');
    }                   
    
    public function indexAction(){         
        $this->view->current_action = "index";
    }

    //===============================  Ajax part =====================
    public function getbusinessAction(){
        
        
        $business = new Business();
        $businessList = $business->getBusinessData();
             
        $a = json_encode($businessList);
        echo($a);exit;

    }
        
}
