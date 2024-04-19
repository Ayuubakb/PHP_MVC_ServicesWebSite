<?php
class Partenaire extends Model {
    public function __construct()
    {
        $this->table = "Partenaire";
        self::getModel();
    }
    public function UpdatePartenaire($data)
    {
        $sql = "UPDATE " . $this->table . " SET nom = :nom, prenom = :prenom, adresse = :adresse WHERE id = :id";
        $query = self::$instance->prepare($sql);
        $query->execute($data);
    }
    public function getcity(string $ville)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE adresse = '" . $ville."'";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getMetier(string $metier)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE Metier = '" . $metier."'";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function updateNbr_commande($data)
    {
        $sql = "UPDATE " . $this->table . " SET nbr_commande = :nbr_commande WHERE id = :id";
        $query = self::$instance->prepare($sql);
        $query->execute($data);
    }
    public function getservices(int $id)
    {
        $sql = "SELECT * FROM Service WHERE id_partenaire = " . $id;
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getComments(int $id)
    {
        //select the top 5 comments of the partenaire by rating
        $sql = "SELECT * FROM Comment WHERE id_partenaire = " . $id . " ORDER BY rating DESC LIMIT 5";
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getIntervention($id){
        $sql = "SELECT * FROM reservation WHERE statut = 'en cours' AND id_partenaire = " . $id;
        $query = self::$instance->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
?>