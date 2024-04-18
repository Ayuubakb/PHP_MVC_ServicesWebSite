<?php
abstract class Model{
    // Informations de la base de données
    private $dns = "mysql:host=localhost;dbname=db";
    private $login = "root";
    private $mdp = "";
    
    // Attribut statique qui contiendra l'unique instance de Model
    protected static $instance = null;

    public $table;
    public $id;

    /*private function __construct()
    {  
    }*/
    public function getModel()
    {
        if (self::$instance === null) {
            try{
                self::$instance = new PDO($this->dns, $this->login, $this->mdp);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->query("SET nameS 'utf8'");
                return self::$instance;
            }catch (PDOException $e){
                echo 'Erreur :'.$e->getMessage();
            }
            
            //self::$instance = new self();
        }
    }
}
?>