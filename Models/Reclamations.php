<?php

class Reclamations extends Model{
    public function __construct(){
        $this->table="reclamations";
        self::getModel();
    }
    public function reportFromClient(int $id_reclameur, int $id_t, String $type_reclamation, String $type_reclamateur,String $motif){
        $dateReclamation=date("Y-m-d");
        $sql="INSERT INTO reclamations (type,dateReclamations,status,Id_T,motif,id_Reclameur,type_reclameur) 
              VALUES ('$type_reclamation','$dateReclamation',0,$id_t,'$motif',$id_reclameur,'$type_reclamateur')";
        $query=self::$instance->prepare($sql);
        $res=$query->execute();
        
    }
}


?>