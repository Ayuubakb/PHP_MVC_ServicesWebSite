<?php
class Partenaires extends Controller{
    public function index(){
        $this->loadModel("Partenaire");
        $profile = $this->Partenaire->find(1);
        $commandes = $this->Partenaire->commandes(1);
//        $commentaires = $this->Partenaire->commentaires(1);
        $services = $this->Partenaire->services(1);
        $this->loadView("index", compact("profile", "commandes","services"));
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
        $commandesnontraitees=$this->Partenaire->commandesnontraitees(1);
        $this->loadView("interventions", compact("Partenaire", "interventions","commandesnontraitees"));
    }
    public function commentaires($rating, $order)
    {
        $this->loadModel("Partenaire");
        if (isset($_POST['rating']) && isset($_POST['sort'])) {
            $rating = $_POST['rating'];
            $order = $_POST['sort'];
        }else{
            $rating = 0;
            $order = "DESC";
        }
        $commentaires = $this->Partenaire->getallcomments(1, $rating, $order);
        $this->loadView("commentaires", compact( "commentaires"));
    }
    public function addservice()
    {
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $this->loadView("addservice", compact("Partenaire"));
    }


}