<?php

class Partenaire extends Model
{
    public function __construct()
    {
        $this->table = "Partenaire";
        self::getModel();
    }

    public function find(int $id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function services(int $id)
    {
        $sql = "SELECT * FROM services WHERE Id_P = $id";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function update(int $id, array $data)
    {
        $sql = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = '$value',";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE id = $id";
        $query = self::$instance->prepare($sql);
        $query->execute();
    }

    public function interventions(int $id)
    {
        $sql = "SELECT * FROM reservation 
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id
                WHERE Id_S in (SELECT id FROM services WHERE Id_P = $id)
                ORDER BY Date_reserv DESC";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function creerPartenaire($data)
    {
        // Perform database insertion
        // Ensure that you properly escape or prepare data to prevent SQL injection

        $sql = "INSERT INTO partenaire (LastName, FirstName, Metier, Ville, Creneaux, YearExperience, Email, Telephone, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
        $query = self::$instance->prepare($sql);
        $query->execute($params);
    }

    public function getallcomments(int $id, int $note, string $order)
    {
        $sql = "SELECT commentaire.* ,services.*,reservation.*,client.*
                FROM commentaire 
                INNER JOIN reservation ON commentaire.Id_R = reservation.id
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id
                WHERE services.Id_P = $id AND commentaire.publisher = 'client' AND commentaire.Rating >= $note
                ORDER BY commentaire.Date_post $order";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function commandes(int $id)
    {
        $sql = "SELECT reservation.*, client.*,services.* FROM reservation 
              INNER JOIN services ON reservation.Id_S = services.id
           INNER JOIN client ON reservation.Id_C = client.id 
           WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = 1) limit 3";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function commandesnontraitees(int $id)
    {
        $sql = "SELECT reservation.id as ID_reserv,reservation.*, client.*,services.* FROM reservation 
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id 
                WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = 1) AND reservation.Statuts = 0";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE reservation SET Statuts = $status WHERE id = $id";
        $query = self::$instance->prepare($sql);
        $query->execute();
    }

    public function addService($service)
    {
        $sql = "INSERT INTO services (Id_P, Nom,Description ,Prix , categorie, sousCategorie, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $service['id'],
            $service['serviceName'],
            $service['serviceDescription'],
            $service['servicePrice'],
            $service['serviceCategory'],
            $service['servicesousCategory'],
            $service['serviceImage']
        ];
        $query = self::$instance->prepare($sql);
        $query->execute($params);
    }

    public function getNotCommented(int $id)
    {
        $sql = "SELECT reservation.*, client.*,services.* FROM reservation 
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id 
                WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) AND reservation.id NOT IN (SELECT Id_R FROM commentaire)";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function historique($id, $status, $order)
    {
        //if statuts 4 is selected then show all the interventions
        if ($status == 4) {
            $sql = "SELECT reservation.*, client.*,services.* FROM reservation 
                    INNER JOIN services ON reservation.Id_S = services.id
                    INNER JOIN client ON reservation.Id_C = client.id 
                    WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) ORDER BY Date_reserv $order";
        } else {
            $sql = "SELECT reservation.*, client.*,services.* FROM reservation 
                    INNER JOIN services ON reservation.Id_S = services.id
                    INNER JOIN client ON reservation.Id_C = client.id 
                    WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) AND reservation.Statuts = $status ORDER BY Date_reserv $order";
        }
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function commentaires(int $id)
    {
        $sql = "SELECT commentaire.* ,services.*,reservation.*,client.*
                FROM commentaire 
                INNER JOIN reservation ON commentaire.Id_R = reservation.id
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id
                WHERE services.Id_P = $id AND commentaire.publisher = 'client'
                ORDER BY commentaire.Rating DESC";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        
    }
    public function updateInfos($data)
    {
        if($data['image']==""){
            $sql = "UPDATE partenaire SET LastName = ?, FirstName = ?, Metier = ?, Ville = ?, Creneaux = ?, YearExperience = ?, Email = ?, Telephone = ? WHERE id = ?";
            $params = [
                $data['LastName'],
                $data['FirstName'],
                $data['Metier'],
                $data['Ville'],
                $data['Creneaux'],
                $data['YearExperience'],
                $data['Email'],
                $data['Telephone'],
                $data['id']
            ];
        }else{
            $sql = "UPDATE partenaire SET LastName = ?, FirstName = ?, Metier = ?, Ville = ?, Creneaux = ?, YearExperience = ?, Email = ?, Telephone = ?, image = ? WHERE id = ?";
            $params = [
                $data['LastName'],
                $data['FirstName'],
                $data['Metier'],
                $data['Ville'],
                $data['Creneaux'],
                $data['YearExperience'],
                $data['Email'],
                $data['Telephone'],
                $data['image'],
                $data['id']
            ];
        }
        $query = self::$instance->prepare($sql);
        $query->execute($params);
    }
    public function getServiceData($id_R){
        $sql = "SELECT services.*,reservation.*
                FROM services 
                INNER JOIN reservation ON services.id = reservation.Id_S
                WHERE reservation.id = $id_R";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getClientData($id_R){
        $sql = "SELECT client.*
                FROM client 
                INNER JOIN reservation ON client.id = reservation.Id_C
                WHERE reservation.id = $id_R";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getPartenaireData($id_R){
        $sql = "SELECT partenaire.*
                FROM partenaire 
                INNER JOIN services ON partenaire.id = services.Id_P
                INNER JOIN reservation ON services.id = reservation.Id_S
                WHERE reservation.id = $id_R";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}

?>