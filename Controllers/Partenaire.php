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
    function update(){
        $this->loadModel("Partenaire");
        $data = array(
            'Lastname' => $_POST['Lastname'],
            'Firstname' => $_POST['Firstname'],
            'Metier' => $_POST['Metier'],
            'Ville' => $_POST['Ville'],
            'Crenaux' => $_POST['Crenaux'],
            'YearExperience' => $_POST['YearExperience'],
            'Note' => $_POST['Note'],
            'Nbr_commande' => $_POST['Nbr_commande'],
            'Email' => $_POST['Email'],
            'Telephone' => $_POST['Telephone']
        );
        $this->Partenaire->UpdatePartenaire($data);
        header('Location: /Partenaire/index?id='.$_POST['id']);
    }
    function delete(){
        $this->loadModel("Partenaire");
        $this->Partenaire->deletePartenaire($_GET['id']);
        header('Location: /Home/index');
    }
}
?>