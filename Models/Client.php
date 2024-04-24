<?php

class Client extends Model{
    public function __construct(){
        $this->table="client";
        self::getModel();
    }
    public function getProfile(int $id){
            $objct=new stdClass();
            $sql="SELECT id,image,LastName,FirstName,Address,Telephone FROM ".$this->table." WHERE id=".$id;
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->infos=$query->fetch();

            $sql="SELECT r.Date_reserv, r.Statuts, s.Nom, p.FirstName, p.LastName,s.image
                  FROM 
                  ((services s INNER JOIN reservation r ON r.Id_S=s.id) Inner JOIN partenaire p ON s.Id_P=p.id)
                  WHERE r.Id_C=".$id." LIMIT 3";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->commandes=$query->fetchAll();

            $sql="SELECT c.id as id,s.Nom as nom, c.message as message, c.Rating as rating, c.Date_post as datePost
                  FROM ((services s INNER JOIN reservation r ON s.id=r.Id_S) INNER JOIN commentaire c ON r.id=c.Id_R)
                  WHERE r.Id_C=".$id." AND c.published=1 AND c.publisher='partenaire'";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->commentaire=$query->fetchAll();

            return json_encode($objct);
    }
    public function getInfos(int $id){
        $sql="SELECT LastName, FirstName, Address, Telephone,image FROM client WHERE id=$id";
        $query=self::$instance->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function updateInfos(String $image, String $firstName, String $LastName, String $Address, String $Telephone ,int $id){
        if(!strcmp($image,"null")){
            $sql="UPDATE client SET 
                LastName='$LastName', FirstName='$firstName', Address='$Address', Telephone='$Telephone' ,image=null
                WHERE id=$id";
        }else{
            $sql="UPDATE client SET 
            LastName='$LastName', FirstName='$firstName', Address='$Address', Telephone='$Telephone' ,image='$image'
            WHERE id=$id";
        }
        $query=self::$instance->prepare($sql);
        $res=$query->execute();
        return $res;
    }

    public function getCommandes(int $id,String $type,String $status, String $sort){
        $objct=new stdClass();
        
        $sql="SELECT r.Date_reserv, r.Statuts, s.Nom, p.FirstName, p.LastName,s.image
        FROM 
        ((services s INNER JOIN reservation r ON r.Id_S=s.id) Inner JOIN partenaire p ON s.Id_P=p.id)
        WHERE r.Id_C=".$id."";
        if(strcmp($type,"Tous")){
            $sql.=" AND p.Metier='$type'";
        }
        if($status!=4){
            $sql.=" AND r.Statuts=$status";
        }
        $sql.=" ORDER BY r.id $sort";
        $query=self::$instance->prepare($sql);
        $query->execute();
        $objct->commandes= $query->fetchAll();
        return json_encode($objct);
    }

    public function getComments(int $id,String $rating, String $sort){
        $objct=new stdClass();
        
        $sql="SELECT s.Nom, c.message, c.Rating, c.Date_post
                  FROM ((services s INNER JOIN reservation r ON s.id=r.Id_S) INNER JOIN commentaire c ON r.id=c.Id_R)
                  WHERE r.Id_C=".$id." AND c.published=1 AND c.publisher='partenaire'";
        if($rating!=0){
            $sql.=" AND c.Rating=$rating";
        }
        $sql.=" ORDER BY c.id $sort";
        $query=self::$instance->prepare($sql);
        $query->execute();
        $objct->commentaire=$query->fetchAll();

        return json_encode($objct);
    }
    
    public function creerClient($data) {
        // Perform database insertion
        // Ensure that you properly escape or prepare data to prevent SQL injection
        // Example:
        $query = "INSERT INTO client (LastName, FirstName, Address, Telephone, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $data['LastName'],
            $data['FirstName'],
            $data['Address'],
            $data['Telephone'],
            $data['Email'], // Adjust to use 'Email' instead of 'email'
            $data['password'] // Adjust to use 'password' instead of 'password'
        ];
        $this->db->execute($query, $params);
    }
}
