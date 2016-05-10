<?php

class Admin_StatisticsController extends Jaycms_Controller_Action
{                                            

 	public function init()
    {
        parent::init();
        $user = Utils::adminuser();
        if ( $user == null ) {
            $this->_redirect('/admin');
        }       
        
        $this->view->current_module = "statistices";
        $this->view->page_title = "STATISTICS";
        $layout = $this->_helper->layout();
        $layout->setLayout('/admin/layout-admin');
    }                   
    
    public function indexAction(){         
        $page = $this->_getParam('page') ? $this->_getParam('page') : 1;
        $this->view->user = Utils::adminuser();         
        $errcode = $this->_getParam('errcode'); 
                
        $franchises = new Franchises();
        $franchisesList = $franchises->getCitiesData();
                          
        $cities_count = $franchises->getCountCities();
        $page_count = $cities_count / 50;
        
        $this->view->citiesList = $franchisesList;
        $this->view->pageCount = $page_count;
        $this->view->curPage = $page;       
        
         
    }
    
    public function getcitiesAction(){
        $arr1 = array(         
         "1",
         "Trident",
         "Internet Explorer 4.0",
         "Win 95+",
         "4",
         "X"         
         );
         
         $arr2 = array("2",
         "Trident",
         "Internet Explorer 4.0",
         "Win 95+",
         "4",
         "X");
         
         $arr3 = array();
         array_push($arr3, $arr1);
         array_push($arr3, $arr2);
         $a = json_encode($arr3);
         echo($a);exit;
    }
    
    public function saveAction(){
        $id = $this->_getParam('idcentro');
        $cod = $this->_getParam('cod');
        $nombre = $this->_getParam('nombre');
        $direccion = $this->_getParam('direccion');
        $ciudad = $this->_getParam('ciudad');
        $cp = $this->_getParam('cp');
        $delflg = $this->_getParam('delflg');
        
        $centro = new Centros($id);
        $errCode = 0;
        if ( !empty($delflg) ) {
            $centro->delete();
            $errCode = 3; //"EL CENTRO HA SIDO BORRADO CORRECTAMENTE";
        }
        else {
            $centro->cod = $cod;
            $centro->centro = $nombre;
            $centro->direccion = $direccion;
            $centro->ciudad = $ciudad;
            $centro->cp = $cp;
            
            if ( empty($id) ) {
                $errCode = 1; //"EL CENTRO HA SIDO CREADO CORRECTAMENTE";
            } else {
                $errCode = 2; //"EL CENTRO HA SIDO GUARDADO CORRECTAMENTE";
            }
            $centro->save();
        }
        $this->_redirect('/admin/centros/index/errcode/' . $errCode);
    }
    
    public function searchAction(){
        $this->_helper->layout->disableLayout();
        $page = $this->_getParam('page') ? $this->_getParam('page') : 1;
        $this->view->user = Utils::adminuser();
        
        $ape = $this->_getParam('ape');
        $ciu = $this->_getParam('ciu');
        $nc = $this->_getParam('nc');
        $nom = $this->_getParam('nom');
        $cen = $this->_getParam('cen');
        
        $where = "1";
        if (!empty($nc)) $where .= " AND cod = '$nc'";
        if (!empty($nom)) $where .= " AND centro like '%$nom%'";
        if (!empty($ape)) $where .= " AND direccion like '%$ape%'";
        if (!empty($ciu)) $where .= " AND ciudad like '%$ciu%'";
        if (!empty($cen)) $where .= " AND cp like '%$cen%'";
        
        $centroModel = new CentrosModel();
        $centroList = $centroModel->fetchAll($where, null, 50, ($page-1) * 50);
        $centroCount = count($centroModel->fetchAll($where));
        $pageCount = ceil($centroCount / 50);
        
        $this->view->centroList = $centroList;
        $this->view->pageCount = $pageCount;
        $this->view->curPage = $page;
    }
    
    public function editAction(){
        $this->_helper->layout->disableLayout();
        $id = $this->_getParam('id');
        
        $centro = new Centros($id);
        
        $this->view->centro = $centro;
        $this->view->user = Utils::adminuser();
    }
    
}
