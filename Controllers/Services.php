<?php


class Services extends Controller
{
    public function index()
    {
        $this->loadModel("Service");
        $services = $this->Service->getAll();
        $this->loadView("index", compact("services"));
    }

    public function show($nom)
    {
        $this->loadModel("Service"); // name of the class inside the loadModel function
        $Services = $this->Service->getService($nom);
        $this->loadView("Show", compact("Services")); 
    }

    public function netGen()
    {
        $this->loadView("Net_Gen"); 
    }

    public function netCanap()
    {
        $this->loadView("Net_Canap"); 
    }

    public function netSurf()
    {
        $this->loadView("Net_Surf"); 
    }

}

?>