<?php

/**
 * @property int $idcentro
 * @property int $cod
 * @property string $centro
 * @property string $direccion
 * @property string $ciudad
 * @property string $cp
 */
class Business extends Core_ActiveRecord_Row {

    public function __construct($id=null){
        parent::__construct(new FranchisesModel(), $id);
    }
    
    public function getBusinessData($page=1)
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT b.id, b.name, f.city, f.enabled as enable, u.id as admin_id, CONCAT(u.name, ' ', u.lastname, ' ', u.lastname2) as owner 
                FROM w_business b LEFT JOIN w_franchises f ON b.city=f.id
                LEFT JOIN w_users u ON b.provider=u.id";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(null, null, 50, ($page-1) * 50);
        return $result;
    }
    
    public function getCountBusiness()
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT b.id, b.name, f.city, f.enabled as enable, u.id as admin_id, CONCAT(u.name, ' ', u.lastname, ' ', u.lastname2) as owner 
                FROM w_business b LEFT JOIN w_franchises f ON b.city=f.id
                LEFT JOIN w_users u ON b.provider=u.id";
        
        $stmt = $db->query($sql);
        $result = count($stmt->fetchAll());
        return $result;
    } 
    
    public function deleteBusiness($ids)
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "DELETE FROM w_franchises where id IN {$ids}";
        //$stmt = $db->
    }
    
}
?>
