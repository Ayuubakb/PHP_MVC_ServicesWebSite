<?php
class Partenaire extends Controller{

    function index(){
        // Instanciation de la classe modèle Partenaire 
        $this->loadModel("Partenaire");
        //get the id of the partenaire from the url 
        $id = $_GET['id'];
        $partenaire=$this->Partenaire->get($id);
        // compact permet de Créer un tableau à partir de variables et de leur valeur
        $this->loadView("index", compact('partenaire'));
    }
    function profile(){
        $this->loadModel("Partenaire");
        $id = $_GET['id'];
        //get the partenaire from the database
        $partenaire=$this->Partenaire->get($id);
        //get services of the partenaire
        $services = $this->Partenaire->getServices($id);
        //get comments of the partenaire
        $comments = $this->Partenaire->getComments($id);
        $this->loadView("Profile", compact('partenaire', 'services', 'comments'));
    }
    function updateProfile(){
        $this->loadModel("Partenaire");
        $id = $_GET['id'];
        $partenaire=$this->Partenaire->get($id);
        $this->loadView("EditProfile", compact('partenaire'));
    }
    function interventions(){
        $this->loadModel("Partenaire");
        $id = $_GET['id'];
        $intervention= $this->Partenaire->getIntervention($id);
        $this->loadView("Interventions", compact('intervention'));
    }
}
?>