<?php

class Admin_IndexController extends Jaycms_Controller_Action
{                                            

 	public function init()
    {
        parent::init();
        $layout = $this->_helper->layout();         
        $layout->setLayout('/admin/layout-login');         
    }                   
    
    public function indexAction(){  
           
        $user = Utils::adminuser();
                               
        if ( $user != null ) {
            $this->_redirect('/admin/home');
        }
        if( !empty($_POST) ){
            $email = $this->_getParam('email');
            $pass = $this->_getParam("pass");
            
            $usersModel = new UsersModel(); 
            
            $user = $usersModel->fetchRow("name = '$email' and pwd = '$pass'");
            //$user = $usersModel->fetchRow();
            //var_dump($user);exit;
            if( $user != null ){
                $adminuser = new Zend_Session_Namespace('adminuser');
                $adminuser->id = $user->id;
                $this->_redirect("/admin/home");
            }

            $this->view->user = $user;
            $this->view->errMsg = 'Invalid login credentials';
        }
    }
    
    public function logoutAction(){
        $user = new Zend_Session_Namespace('adminuser');
        $user->id = null;
        $this->_redirect('/admin');
    }
    
}
