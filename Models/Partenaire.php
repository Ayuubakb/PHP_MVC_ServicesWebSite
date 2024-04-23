<?php
class Partenaire extends Model {
    public function __construct()
    {
        $this->table = "Partenaire";
        self::getModel();
    }
    public function find(int $id){
        $sql= "SELECT * FROM $this->table WHERE id = $id";
        $query= self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function services(int $id){
        $sql= "SELECT * FROM services WHERE Id_P = 1";
        $query= self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function commentaires(int $id){
        $sql= "SELECT * FROM commentaire WHERE Id_S = 1";
        $query= self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function update(int $id, array $data){
        $sql= "UPDATE $this->table SET ";
        foreach ($data as $key => $value){
            $sql .= "$key = '$value',";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE id = $id";
        $query= self::$instance->prepare($sql);
        $query->execute();
    }
    public function interventions(int $id){
        $sql= "SELECT * FROM reservation WHERE Id_S in (SELECT id FROM services WHERE Id_P = 1)";
        $query= self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function creerPartenaire($data) {
        // Perform database insertion
        // Ensure that you properly escape or prepare data to prevent SQL injection
        
        $query = "INSERT INTO partenaire (LastName, FirstName, Metier, Ville, Creneaux, YearExperience, Email, Telephone, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $data['LastName'],
            $data['FirstName'],
            $data['Metier'],
            $data['Ville'],
            $data['Creneaux'],
            $data['YearExperience'],
            $data['Email'],
            $data['Telephone'],
            $data['password']
        ];
        $this->db->execute($query, $params);
    }
}
?>