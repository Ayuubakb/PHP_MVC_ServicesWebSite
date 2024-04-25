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
         WHERE Id_S in (SELECT id FROM services WHERE Id_P = $id)";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function creerPartenaire($data)
    {
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

    public function getallcomments(int $id, int $note, string $order)
    {
        //check if the order is DESC or ASC
        if ($order == "DESC" || $order == "ASC") {
            $sql = "SELECT commentaire.* ,services.*,reservation.*,client.*
                FROM commentaire 
               INNER JOIN reservation ON commentaire.Id_R = reservation.id
               INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id
               WHERE services.Id_P = 1 AND commentaire.Rating >= $note and commentaire.publisher = 'client'
               ORDER BY commentaire.Date_post $order";
        } else {
            $sql = "SELECT commentaire.* FROM commentaire 
               INNER JOIN reservation ON commentaire.Id_R = reservation.id
                INNER JOIN services ON reservation.Id_S = services.id
               WHERE services.Id_P = 1 AND commentaire.Rating >= $note AND commentaire.publisher = 'client' ";

        }
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

}

?>