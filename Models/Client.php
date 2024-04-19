<?php

class Client extends Model{
    public function __construct(){
        $this->table="client";
        self::getModel();
    }
    public function getProfile(int $id){
            $objct=new stdClass();
            $sql="SELECT image,LastName,FirstName,Address,Telephone FROM ".$this->table." WHERE id=".$id;
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->infos=$query->fetch();

            $sql="SELECT r.Date_reserv, r.Statuts, s.Nom, p.FirstName, p.LastName 
                  FROM 
                  ((services s INNER JOIN reservation r ON r.Id_S=s.id) Inner JOIN partenaire p ON s.Id_P=p.id)
                  WHERE r.Id_C=".$id." LIMIT 5";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->commandes=$query->fetchAll();

            $sql="SELECT s.Nom, c.message, c.Rating, c.Date_post
                  FROM ((services s INNER JOIN reservation r ON s.id=r.Id_S) INNER JOIN commentaire c ON r.id=c.Id_R)
                  WHERE r.Id_C=".$id." AND c.published=1 AND c.publisher='partenaire'";
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->reservation=$query->fetchAll();

            return json_encode($objct);
    }
}
