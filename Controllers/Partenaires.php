<?php
class Partenaires extends Controller{
    public function index(){
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $this->loadView("index", compact("Partenaire"));
    }
    public function profil(){
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $services = $this->Partenaire->services(1);
        $commentaires = $this->Partenaire->commentaires(1);
        $this->loadView("Profile", compact("Partenaire", "services","commentaires"));
    }
    public function updateprofile(){
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $this->loadView("update", compact("Partenaire"));
    }
    public function interventions()
    {
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $interventions = $this->Partenaire->interventions(1);
        $this->loadView("interventions", compact("Partenaire", "interventions"));
    }


}