<?php

class Admin_CitiesController extends Jaycms_Controller_Action
{                                            

 	public function init()
    {
        parent::init();
        $user = Utils::adminuser();
        if ( $user == null ) {
            $this->_redirect('/admin');
        }       
        
        $this->view->current_module = "cities";
        
        $this->view->page_title = "CITIES";
        $layout = $this->_helper->layout();
        $layout->setLayout('/admin/layout-admin');
    }                   
    
    public function indexAction(){ 
        $this->view->current_action = "index";         
    }
    
    public function createAction(){ 
        
        $this->view->current_action = "create"; 
        
        $franchises = new Franchises();
        $users = new Users();
        $countries = new Countries();
        
        $adminList = $users->getAdministrators();
        $countryList = $countries->getCountries();
                
        $this->view->adminList = $adminList;
        $this->view->countryList = $countryList;
        
    }
    
    public function createresultAction(){
        $city = $this->_getParam('city');
        $email = $this->_getParam('email');
        $admin_id = $this->_getParam('administrator');
        $country = $this->_getParam('country');
        $currency = $this->_getParam('currency');
        $ga_id = $this->_getParam('ga_id');
        $zone = $this->_getParam('zone');
        
        /*
        $sql = "INSERT INTO w_franchises(`city`, `admin`, `enabled`, `email`, `country`, `ga`, `timezone`, `currency`)  VALUES
                ('{$city}', '{$admin_id}', '1', '{$email}', '{$country}', '{$ga_id}', '{$zone}', '{$currency}');
            ";
        */    
        $franchises = new Franchises();
        
        $franchises->city = $city;
        $franchises->admin = $admin_id;
        $franchises->enabled = 1;
        $franchises->email = $email;
        $franchises->country = $country;
        $franchises->ga = $ga_id;
        $franchises->timezone = $zone;
        $franchises->currency = $currency;
        
        $franchises->save();
        $this->_redirect('/admin/cities');         
    }
    
    public function editAction(){ 
        
        $this->view->current_action = "edit"; 
        
        $id = $this->_getParam('id');
        
        $franchises = new Franchises($id);
        
        
        $users = new Users();
        $countries = new Countries();
        
        $adminList = $users->getAdministrators();
        $countryList = $countries->getCountries();
                
        $city_info = array('city'=>"$franchises->city", 'email'=>"$franchises->email", 'admin'=>"$franchises->admin", 
                            'country'=>"$franchises->contry", 'ga'=>"$franchises->ga", 'timezone'=>"$franchises->timezone", 
                            'currency'=>"$franchises->currency");
        
        $this->view->adminList = $adminList;
        $this->view->countryList = $countryList;        
        $this->view->cityinfo = $city_info;
        
    }
    
    public function editresultAction(){
        $city = $this->_getParam('city');
        $email = $this->_getParam('email');
        $admin_id = $this->_getParam('administrator');
        $country = $this->_getParam('country');
        $currency = $this->_getParam('currency');
        $ga_id = $this->_getParam('ga_id');
        $zone = $this->_getParam('zone');
        /*
        $sql = "UPDATE w_franchises SET city='{$city}', admin='{$admin_id}', enabled='1', email='{$email}', country={$country}, ga='{$ga_id}', timezone='{$zone}', currency='{$currency}'";
        */
        
        $id = $this->_getParam('id');
        //var_dump($_REQUEST);exit; 
        //var_dump($id);exit;       
        $franchises = new Franchises($id);        
        
        $franchises->city = $city;
        $franchises->admin = $admin_id;
        $franchises->enabled = 1;
        $franchises->email = $email;
        $franchises->country = $country;
        $franchises->ga = $ga_id;
        $franchises->timezone = $zone;
        $franchises->currency = $currency;
        
        $franchises->save();
        $this->_redirect('/admin/cities');         
    }    
    
    public function deleteAction(){ 
        
        $this->view->current_action = "delete"; 
        
        $ids = $this->_getParam('ids');
        
        $id_arr = explode(",", $ids);
        
        foreach($id_arr as $id)
        {
            $franchises = new Franchises($id);
            $franchises->delete();   
        }                         
        
        $this->_redirect('/admin/cities');
    }
    
    
    //===============================  Ajax part =====================
    public function getcitiesAction(){
        
        
        $franchises = new Franchises();
        $franchisesList = $franchises->getCitiesData();
             
        $a = json_encode($franchisesList);
        echo($a);exit;

    }
    

    
}
