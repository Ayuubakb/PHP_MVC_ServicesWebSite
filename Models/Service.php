

<?php

class Service extends Model {
    public function __construct() {
        $this->table = "services";
        self::getModel();
    }

    public function getService(String $nom) {
        $sql = "SELECT * FROM " . $this->table . " WHERE s.Nom = '" . $nom."'";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_Offre(String $nom){
        
        $sql = "SELECT s.*, p.LastName, p.FirstName  FROM " . $this->table . " s INNER JOIN partenaire p ON s.Id_P=p.id WHERE sousCategorie = '" . $nom."'";
        
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    
}
?>