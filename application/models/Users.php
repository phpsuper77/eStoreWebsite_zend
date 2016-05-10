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
class Users extends Core_ActiveRecord_Row {

    public function __construct($id=null){                    
        return parent::__construct(new UsersModel(), $id);
    }
        
    public function getAdministrators(){
        $db = Zend_Registry::get('db1'); 
                    
        $sql = "SELECT CONCAT(u.name, ' ', u.lastname) as administrator, u.id as admin_id FROM w_users u WHERE u.level=1";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        return $result; 
    }
}
?>