<?php
    class Authentificate extends Model{
        public function __construct(){
            $this->table="client";
            self::getModel();
        }
        public function getUserByEmail(String $email){
            $sqlClient="SELECT * FROM client where email='$email'";
            $sqlPartenaire="SELECT * FROM partenaire where email='$email'";
            $query=self::$instance->prepare($sqlClient);
            $query->execute();
            $user=$query->fetch();
            if($user){
                return $user;
            }else{
                $query=self::$instance->prepare($sqlPartenaire);
                $query->execute();
                $user=$query->fetch();
                return $user;
            }
        }
    }
?>