<?php
require 'PHPMAILER/vendor/phpmailer/phpmailer/src/Exception.php';
require 'PHPMAILER/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'PHPMAILER/vendor/phpmailer/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Partenaires extends Controller
{
    public function index($id)
    {
        session_start();
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
        $profile = json_decode($this->Partenaire->getComments($id, $rating, $order));
        
        $this->loadView("commentaires", compact("profile"));
    }

    public function updateStatus()
    {
        session_start();
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
        $commented= $this->Partenaire->commentedbypartenaire($id);
        $this->loadView("Historique", compact("historique", "commented"));
    }

    public function interventions()
    {
        session_start();
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->find($_SESSION['user_id']);
        $interventions = $this->Partenaire->interventions($_SESSION['user_id']);
        $commandesnontraitees = $this->Partenaire->commandesnontraitees($_SESSION['user_id']);
        $this->loadView("interventions", compact("Partenaire", "interventions", "commandesnontraitees"));
    }

    public function addservice($id)

    {
        session_start();
        $this->loadModel("Partenaire");
        $metier=$this->Partenaire->getMetier($_SESSION['user_id']);
        $this->loadView("addservice",compact("metier"));
    }
    public function updateInfos()
    {
        session_start();
        $this->loadModel("Partenaire");
        //check for img upload
        if (isset($_FILES['pic']) && $_FILES['pic']['error'] == 0) {
            $uploadDir = '../Views/public/images/';
            $uploadFile = $uploadDir . basename($_FILES['pic']['name']);
            if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadFile)) {
                echo "The file has been uploaded successfully.";
            } else {
                echo "An error occurred during the file upload.";
            }
        } else {
            echo "An error occurred.";
        }
        print_r($_POST);
        $days = $_POST['day'];
$fromTimes = $_POST['from'];
$toTimes = $_POST['to'];

$Creneaux = "";

for($i = 0; $i < count($days); $i++) {
    // Remove the ":00" from the times
    $from = str_replace(":00", "", $fromTimes[$i]);
    $to = str_replace(":00", "", $toTimes[$i]);
    $Creneaux .= $days[$i] . ":" . $from . "-" . $to . "/";
}
echo $Creneaux;
        $profile = [
            "id" => $_SESSION['user_id'],
            "FirstName" => $_POST['firstName'],
            "LastName" => $_POST['lastName'],
            "Metier" => $_POST['Metier'],
            "Ville" => $_POST['Ville'],
            "YearExperience" => $_POST['YearExperience'],
            "Email" => $_POST['Email'],
            "Telephone" => $_POST['Telephone'],
            "Creneaux" => $Creneaux,
            "image" => basename($_FILES['pic']['name'])
        ];
        $this->Partenaire->updateInfos($profile);
        header("Location: http://localhost/Bricolini/Partenaires/index/" . $_SESSION['user_id']);
    }
    public function sendMail(){
        $id_R = $_POST['id'];
        $this->loadModel("Partenaire");
        $Partenaire = $this->Partenaire->getPartenaireData($id_R);
        $Client = $this->Partenaire->getClientData($id_R);
        $Service = $this->Partenaire->getServiceData($id_R);
        //send the email to the partenaire with the client data
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bricolini.ensate@gmail.com';
        $password='ufhlwsckpttcearl';
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'bricolini.ensate@gmail.com';
        $mail->FromName = 'Bricolini';
        $mail->addAddress($Partenaire['Email'], $Partenaire['FirstName'] . ' ' . $Partenaire['LastName']);
        $mail->isHTML(true);
        $mail->Subject = 'Reservation Confirmation';
        $mail->Body = 'Dear ' . $Partenaire['FirstName'] . ' ' . $Partenaire['LastName'] . ',<br><br>Your reservation with ' . $Client['FirstName'] . ' ' . $Client['LastName'] . ' on ' . $Service['Date_reserv'] . '
           For the service : '.$Service['Nom'].' has been confirmed.
            <br>
            The client email is : '.$Client['email'].'
            <br>
            The client phone number is : '.$Client['Telephone'].'
            <br>
            The client address is : '.$Client['Address'].'
            <br>
            <br><br>Best regards,<br>Bricolini';
            if ($mail->send()) {
                echo 'Email has been sent';
            } else {
                echo 'Email could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
    }
    public function deleteservice($id){
        session_start();
        $this->loadModel("Partenaire");
        $this->Partenaire->deleteservice($id);
        echo "delete succcefely ";
        header("Location: http://localhost/Bricolini/Partenaires/index/" . $_SESSION['user_id']);
    }
}