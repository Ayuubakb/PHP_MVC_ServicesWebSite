<?php

class Client extends Model{
    public function __construct(){
        $this->table="client";
        self::getModel();
    }
    public function getProfile(int $id){
            $dateNow=date("Y-m-d");
            $sql="SELECT id,Date_reserv FROM reservation WHERE Id_C=$id and Statuts=1";
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

            $array=array();
            $sql="SELECT id,Date_reserv from reservation where Id_C=$id";
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
                $sql="SELECT c.id as id,s.Nom as nom, c.message as message, c.Rating as rating, c.Date_post as datePost, p.LastName as ln, p.FirstName as fn 
                        FROM (((services s INNER JOIN reservation r ON s.id=r.Id_S) INNER JOIN commentaire c ON r.id=c.Id_R) INNER JOIN partenaire p ON p.id=s.Id_P)
                        WHERE c.Id_R IN (" . implode(',', $array) . ") AND c.publisher = 'partenaire' LIMIT 5";
                $query=self::$instance->prepare($sql);
                $query->execute();
                $objct->commentaire=$query->fetchAll();
            }else{
                $objct->commentaire=array();
            }

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
                LastName='$LastName', FirstName='$firstName', Address='$Address', Telephone='$Telephone'
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
        
        $sql="SELECT r.id ,r.Date_reserv, r.Statuts, s.Nom, p.FirstName, p.LastName,s.image
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
        $array=array();
        $sql="SELECT id,Date_reserv from reservation where Id_C=$id";
        $query=self::$instance->prepare($sql);
        $query->execute();
        $reservations=$query->fetchAll();
        foreach($reservations as $reservation){
            $flag1=false; 
            $flag2=false;
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
            $sql="SELECT c.id as id,s.Nom as nom, c.message as message, c.Rating as rating, c.Date_post as datePost, p.LastName as ln, p.FirstName as fn 
                    FROM (((services s INNER JOIN reservation r ON s.id=r.Id_S) INNER JOIN commentaire c ON r.id=c.Id_R) INNER JOIN partenaire p ON p.id=s.Id_P)
                    WHERE c.Id_R IN (" . implode(',', $array) . ") AND c.publisher = 'partenaire'";
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
    
    public function creerClient($data) {
        // Perform database insertion
        // Ensure that you properly escape or prepare data to prevent SQL injection
        // Example:
        $sql = "INSERT INTO client (LastName, FirstName, Address, Telephone, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $data['LastName'],
            $data['FirstName'],
            $data['Address'],
            $data['Telephone'],
            $data['Email'], // Adjust to use 'Email' instead of 'email'
            $data['password'] // Adjust to use 'password' instead of 'password'
        ];
        $query=self::$instance->prepare($sql);
        $query->execute($params);
    }
    public function getPartenaires(String $nom,String $ville, int $rating, String $metier){
        $flag=false;
        $sql="SELECT id,image,LastName , FirstName, Metier, Ville, YearExperience, Note, Telephone FROM partenaire";
        if(strcmp($nom,"")!=0){
            if(!$flag)
                $sql.=" WHERE LastName LIKE '%$nom%' OR FirstName LIKE '%$nom%' ";
            else
                $sql.=" AND LastName LIKE '%$nom%' OR FirstName LIKE '%$nom%' ";
            $flag=true;
        }
        if(strcmp($ville,"")!=0){
            if(!$flag)
                $sql.=" WHERE Ville LIKE '%$ville%'";
            else
                $sql.=" AND Ville LIKE '%$ville%'";
            $flag=true;
        }
        if($rating!=6){
            if(!$flag)
                $sql.=" WHERE Note=$rating";
            else
                $sql.=" AND Note=$rating";
            $flag=true;
        }
        if(strcmp($metier,"")!=0){
            if(!$flag)
                $sql.=" WHERE Metier='$metier'";
            else
                $sql.=" AND Metier='$metier'";
            $flag=true;
        }
        $query=self::$instance->prepare($sql);
        $query->execute();
        $partenaires=$query->fetchAll();
        return $partenaires;
    }  
}
