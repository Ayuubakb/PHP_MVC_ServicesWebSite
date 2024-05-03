<?php
class Partenaires extends Controller{
    public function index($id){
        $this->loadModel("Partenaire");
        $profile = $this->Partenaire->find($id);
        $commandes = $this->Partenaire->commandes($id);
//        $commentaires = $this->Partenaire->commentaires($id);
        $services = $this->Partenaire->services($id);
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

    public function updateStatus() {
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
    public function Historique(){
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find(1);
        $interventions = $this->Partenaire->interventions(1);
        $this->loadView("Historique", compact("Partenaire", "interventions"));
    }
    public function handleAddService(){
    $this->loadModel("Partenaire");

    // Check if the file was uploaded without errors
    if(isset($_FILES['serviceImage']) && $_FILES['serviceImage']['error'] == 0){
        // The path of the upload destination
        $uploadDir = 'http://localhost/Bricolini/Views/public/images/';

        // Get the service name from the form data
        $serviceName = $_POST['serviceName'];
        //remove spaces from the service name and replace them with underscores
        $serviceName = str_replace(' ', '_', $serviceName);
        //save the file in uploads directory
        $uploadFile = $uploadDir . basename($serviceName . $_FILES['serviceImage']['name']);
        // Move the file to the upload directory
        if(move_uploaded_file($_FILES['serviceImage']['tmp_name'], $uploadFile)){
            echo "The file has been uploaded successfully.";
        } else{
            echo "An error occurred during the file upload.";
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
        "serviceImage" => $serviceName . $_FILES['serviceImage']['name']
    ];

    $this->Partenaire->addService($service);
    echo "Service added successfully";
    header("Location: http://localhost/Bricolini/Partenaires/index/".$_POST['id']);
}
    


}