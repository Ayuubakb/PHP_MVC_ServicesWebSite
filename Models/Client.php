<?php

class Client extends Model{
    public function __construct(){
        $this->table("client");
        self::getModel();
    }
    public function getProfile(int $id){
        if(isset($_SESSION["id"])){
            $objct=new stdClass();
            $sql="SELECT LastName,FirstName,Adress,Telephone FROM ".$this->table." WHERE id=".$id;
            $query=self::$instance->prepare($sql);
            $query->execute();
            $objct->infos=$query;
        }
    }
}
