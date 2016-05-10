<?php

    /**
     * @property int $idvendedor         
     * @property string $nombre
     * @property string $apellido
     * @property string $estado
     * @property string $usuario
     * @property string $pass
     * @property string $observaciones
     * @property int $idcentro
     * @property int $is_super
     * 
     * @property Centros $centro
     */
class Countries extends Core_ActiveRecord_Row {

    public function __construct($id=null){                    
        return parent::__construct(new UsersModel(), $id);
    }
        
    public function getCountries(){
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT name as country, id as country_id FROM w_countries";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        return $result; 
    }
}
?>