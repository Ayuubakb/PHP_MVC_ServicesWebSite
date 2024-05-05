<?php


class Services extends Controller
{
    public function index()
    {
        session_start();
        $this->loadView("index");
    }

    public function show($nom)
    {
        session_start();
        $this->loadModel("Service"); // name of the class inside the loadModel function
        $Services = $this->Service->getService($nom);
        $this->loadView("Show", compact("Services"));  
    }

    public function nettoyagegeneral()
    {
        session_start();
        $sousCategorie = "Nettoyage général";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Net_Gen", compact("Services")); 
    }

    public function nettoyagedecanapes()
    {
        session_start();
        $sousCategorie = "Nettoyage de canapés";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Net_Canap", compact("Services"));
    }

    public function nettoyagedessurfaces()
    {
        session_start();
        $sousCategorie = "Nettoyage des surfaces";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Net_Surf", compact("Services"));
    }

    public function entretiengazon()
    {
        session_start();
        $sousCategorie = "Entretien de Gazon et Pelouse";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Ent_Gazon", compact("Services"));
    }

    public function traitementjardin()
    {
        session_start();
        $sousCategorie = "Traitement de jardin";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Trait_Jard", compact("Services"));
    }

    public function plantationjardin()
    {
        session_start();
        $sousCategorie = "Plantation pour jardin";
        $this->loadModel("Service");
        $Services = $this->Service->get_Offre($sousCategorie);
        $this->loadView("Plant_Jard", compact("Services"));
    }
    

}

?>