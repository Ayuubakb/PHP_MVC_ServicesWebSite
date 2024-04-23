<?php


class Services extends Controller
{
    public function index()
    {
        $this->loadModel("Service");
        $Services = $this->Service->getAll();
        $this->loadView("index", compact("Services"));
    }

    public function show($nom)
    {
        $this->loadModel("Service"); // name of the class inside the loadModel function
        $Services = $this->Service->getService($nom);
        $this->loadView("Show", compact("Services"));  
    }

    public function nettoyagegeneral()
    {
        $this->loadView("Net_Gen"); 
    }

    public function nettoyagedecanapes()
    {
        $this->loadView("Net_Canap"); 
    }

    public function nettoyagedessurfaces()
    {
        $this->loadView("Net_Surf"); 
    }

}

?>