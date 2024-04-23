

<?php

class Service extends Model {
    public function __construct() {
        $this->table = "services";
        self::getModel();
    }

    public function getService(String $nom) {
        $sql = "SELECT * FROM " . $this->table . " WHERE Nom = '" . $nom."'";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_Offre(String $nom){
        
        $sql = "SELECT * FROM " . $this->table . " WHERE sousCategorie = '" . $nom."'";
        
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    
}
?>