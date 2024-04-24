<?php
class Users extends Model
{
    public function __construct(){
        
        self::getModel();
    }
    public function getAllUsers()
    {
        // Establish database connection
       // $pdo = new PDO("mysql:host=localhost;dbname=db", "root", "");

        // Fetch clients
        /*$clientStatement = $pdo->query("SELECT * FROM client");
        $clients = [];
        while ($row = $clientStatement->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = $row;
        }*/
        $query=self::$instance->prepare("SELECT * FROM client");
        $query->execute();
        $clients=$query->fetchAll();

        // Fetch partenaires
       /* $partenaireStatement = $pdo->query("SELECT * FROM partenaire");
        $partenaires = [];
        while ($row = $partenaireStatement->fetch(PDO::FETCH_ASSOC)) {
            $partenaires[] = $row;
        }*/

        $query=self::$instance->prepare("SELECT * FROM partenaire");
        $query->execute();
        $partenaires=$query->fetchAll();
        // Close the database connection
        //$pdo = null;

        return ['clients' => $clients, 'partenaires' => $partenaires];
    }
}


?>
