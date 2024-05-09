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
            $dateNow=date("Y-m-d");
            $sql="SELECT r.id,r.Date_reserv FROM reservation r INNER JOIN services s ON r.Id_S=s.id WHERE s.Id_P=$id";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $re=$query->fetchAll();
            foreach($re as $res){
               if($dateNow > date("Y-m-d",strtotime($res['Date_reserv']))){
                    $idR=$res['id'];
                    $sql="UPDATE reservation SET Statuts=3 WHERE id=$idR";
                    $query=self::$instance->prepare($sql);
                    $query->execute();
               }
            }
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
        $sql = "SELECT client.LastName, client.FirstName, services.image, reservation.id, services.Nom, reservation.Statuts, reservation.Date_reserv
                 FROM reservation 
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
           WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) limit 3";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function commandesnontraitees(int $id)
    {
        $sql = "SELECT reservation.id as ID_reserv,reservation.*, client.*,services.* FROM reservation 
                INNER JOIN services ON reservation.Id_S = services.id
                INNER JOIN client ON reservation.Id_C = client.id 
                WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) AND reservation.Statuts = 0";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE reservation SET Statuts = $status WHERE id = $id";
        $query = self::$instance->prepare($sql);
        $query->execute();
        if($status==1){
            $sql="UPDATE services SET Nbr_commande=Nbr_commande+1 WHERE id=(SELECT Id_S FROM reservation WHERE id=$id)";
            $query= self::$instance->prepare($sql);
            $query->execute();
            $sql="UPDATE partenaire SET Nbr_commande=Nbr_commande+1 WHERE id=(SELECT Id_P FROM services WHERE id=(SELECT Id_S FROM reservation WHERE id=$id))";
            $query= self::$instance->prepare($sql);
            $query->execute();
        }
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
                    WHERE reservation.Id_S in (SELECT id FROM services WHERE Id_P = $id) AND reservation.Statuts = $status
                    AND column_name != client.id AND column_name != services.id
                    ORDER BY Date_reserv $order";
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
    public function commentedbypartenaire($id)
    {
        $sql = "SELECT id_R
                FROM commentaire 
                INNER JOIN reservation ON commentaire.Id_R = reservation.id
                INNER JOIN services ON reservation.Id_S = services.id
                WHERE services.Id_P = $id AND commentaire.publisher = 'partenaire'";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function deleteservice($id)
    {
        $sql="DELETE FROM services WHERE id=$id";
        $query=self::$instance->prepare($sql);
        $query->execute();
    }
    public function getMetier($id){
        $sql="SELECT Metier From partenaire Where id=$id";
        $query=self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getComments(int $id,String $rating, String $sort){
        $objct=new stdClass();
        $array=array();
        $sql="SELECT id,Date_reserv from reservation where Id_S IN (SELECT id FROM services WHERE Id_P=$id)";
        $query=self::$instance->prepare($sql);
        $query->execute();
        $reservations=$query->fetchAll();
        $flag1=false;
        $flag2=false;
        foreach($reservations as $reservation){
            $idR=$reservation["id"];
            $sql="SELECT * from commentaire where Id_R=$idR";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $comments=$query->fetchAll();
            foreach($comments as $comment){
                if(!strcmp($comment['publisher'],"client")){
                    $flag1=true;
                }
                if(!strcmp($comment['publisher'],"partenaire")){
                    $flag2=true;
                }
            }
            if(($flag1 && $flag2) || date("Y-m-d") > date("Y-m-d",strtotime($reservation["Date_reserv"]. ' + 7 days'))){
                $array[]=$reservation['id'];
            }
        }

        if(sizeof($array)!=0){
            $sql="SELECT c.id as id , s.Nom as nom , c.message as message ,c.Rating as rating ,
            c.Date_post as datePost, cl.LastName as ln, cl.FirstName as fn 
            FROM  ((((services s INNER JOIN reservation r ON s.id=r.Id_S)
            INNER JOIN  commentaire c ON r.id=c.Id_R) INNER JOIN partenaire p ON p.id=s.Id_P)
            INNER JOIN client cl ON cl.id=r.Id_C)
            WHERE c.Id_R IN (" . implode(',', $array) . ") AND c.publisher = 'client' ";
            if($rating!=0){
                $sql.=" AND c.Rating=$rating";
            }
            $sql.=" ORDER BY c.id $sort";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->commentaire=$query->fetchAll();
        }else{
            $objct->commentaire=array();
        }
        return json_encode($objct);
    }
}   

?>