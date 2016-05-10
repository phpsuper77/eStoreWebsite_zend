<?php

/**
 * @property int $idcentro
 * @property int $cod
 * @property string $centro
 * @property string $direccion
 * @property string $ciudad
 * @property string $cp
 */
class Franchises extends Core_ActiveRecord_Row {

    public function __construct($id=null){
        parent::__construct(new FranchisesModel(), $id);
    }
    
    public function getCitiesData($page=1)
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT f.id, f.city, f.enabled as enable, u.id as admin_id, CONCAT(u.name, ' ', u.lastname) as administrator FROM w_franchises f, w_users u where f.admin=u.id";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(null, null, 50, ($page-1) * 50);
        return $result;
    }
    
    public function getCountCities()
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT f.city, f.enabled, u.id, u.name, u.lastname FROM w_franchises f, w_users u where f.admin=u.id";
        $stmt = $db->query($sql);
        $result = count($stmt->fetchAll());
        return $result;
    }
    
    public function deleteCities($ids)
    {
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "DELETE FROM w_franchises where id IN {$ids}";
        //$stmt = $db->
    }
    
}
?>
