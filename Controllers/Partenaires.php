<?php

class Partenaires extends Controller
{
    public function index($id)
    {
        session_start() ;
        $this->loadModel("Partenaire");
        $profile = $this->Partenaire->find($id);
        $commandes = $this->Partenaire->commandes($id);
        $commentaires = $this->Partenaire->commentaires($id);
        $services = $this->Partenaire->services($id);
        $this->loadView("index", compact("profile", "commandes", "services", "commentaires"));
    }

    public function updateprofile($id)
    {
        session_start();
        $this->loadModel("Partenaire");
        $profile = $this->Partenaire->find($id);
        $this->loadView("update", compact("profile"));
    }

    public function commentaires($rating, $order)
    {
        session_start();
        $this->loadModel("Partenaire");
        $id = $_SESSION['user_id'];
        $commentaires = $this->Partenaire->getallcomments($id, $rating, $order);
        $this->loadView("commentaires", compact("commentaires"));
    }

    public function updateStatus()
    {

        $this->loadModel("Partenaire");
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $this->Partenaire->updateStatus($id, $status);
            echo "Success";
        } else {
            echo "Error";
        }
    }
    public function Historique($status, $order)
    {
        session_start();
        $id=$_SESSION['user_id'];
        $this->loadModel("Partenaire");
        $historique = $this->Partenaire->historique($id, $status, $order);
        //add the var in a array and send it to the view
        $var= array("parametre1"=>$status,"parametre2"=>$order,"parametre3"=>$id);
        $this->loadView("Historique", compact("historique","var"));
    }

    public function handleAddService(){
    $this->loadModel("Partenaire");

    // Check if the file was uploaded without errors
    if(isset($_FILES['serviceImage']) && $_FILES['serviceImage']['error'] == 0){
        // The path of the upload destination
        $uploadDir = '../Views/public/images/';

        // Get the service name from the form data
        $serviceName = $_POST['serviceName'];
        //remove spaces from the service name and replace them with underscores
        $imageName = str_replace(' ', '_', $serviceName);
        //save the file in uploads directory
        $uploadFile = $uploadDir . $imageName . basename($_FILES['serviceImage']['name']);

        // Check if the file size is 0
        if(filesize($_FILES['serviceImage']['size']) == 0){
            echo "The file size is zero.";
        }else{
            // Move the file to the upload directory
            if(move_uploaded_file($_FILES['serviceImage']['tmp_name'], $uploadFile)){
                echo "The file has been uploaded successfully.";
            } else{
                echo "An error occurred during the file upload.";
            }
        }
    } else{
        echo "An error occurred.";
    }

    $service = [
        "id" => $_POST['id'],
        "serviceName" => $serviceName,
        "serviceDescription" => $_POST['serviceDescription'],
        "servicePrice" => $_POST['servicePrice'],
        "serviceCategory" => $_POST['serviceCategory'],
        "servicesousCategory" => $_POST['servicesousCategory'],
        "serviceImage" => $imageName . basename($_FILES['serviceImage']['name'])
    ];

    $this->Partenaire->addService($service);
    echo "Service added successfully";
    header("Location: http://localhost/Bricolini/Partenaires/index/".$_POST['id']);
}

    public function interventions()
    {
        session_start();
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $interventions = $this->Partenaire->interventions(1);
        $commandesnontraitees = $this->Partenaire->commandesnontraitees(1);
        $this->loadView("interventions", compact("Partenaire", "interventions", "commandesnontraitees"));
    }

    public function addservice()

    {
        $this->loadModel("Partenaire");
        $this->loadView("addservice");
    }


}