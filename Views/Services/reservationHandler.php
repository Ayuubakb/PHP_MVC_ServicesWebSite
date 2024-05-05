<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['user_id'])){
        $inCreneuax=false;
        $dispo=false;
        // print "user_id: ";
        $Id_S = $_POST['Id_S'];
        $Date_reserv = $_POST['Date_reserv'];
        $hours_from = $_POST['hours_from'];
        $de=explode(":",$hours_from)[0];
        $hours_to= $_POST['hours_to'];
        $a=explode(":",$hours_to)[0];
        $Id_C = $_SESSION['user_id'];
        $Statuts = $_POST['Statuts'];
        $sql="SELECT p.Creneaux FROM services s INNER JOIN partenaire p ON p.id=s.Id_P WHERE s.id = $Id_S";
        //traitelent creneaux
        if($stmt=$conn->prepare($sql)){
            $stmt->execute();

            $stmt->bind_result($creneaux);
            $Cr;
            while ($stmt->fetch()) {
                $Cr=$creneaux;
            }
            $days=explode("/",$Cr);
            foreach ($days as $day) {
                $tmp=explode(":",$day);
                $jour=$tmp[0];
                $creneaux=$tmp[1];
                $tmp=explode("-",$creneaux);
                $debut=$tmp[0];
                $fin=$tmp[1];
                $selectedDate = date('l', strtotime($Date_reserv));
               
                if(!strcmp($jour,$selectedDate) && (intval($debut)<=intval($de) && intval($fin)>=intval($a)) ){ 
                    $inCreneuax=true;
                }
            }
        }
        $sql="SELECT count(*) FROM ((services s 
        INNER JOIN reservation r ON r.Id_S=s.id)
        INNER JOIN partenaire p ON p.id=s.Id_P) 
        WHERE s.id = $Id_S 
        AND r.Date_reserv = '$Date_reserv'
        AND '$de' between r.heureDe and r.heureA 
        AND '$a' between r.heureDe and r.heureA";
        //trairtement disponibilite
        if($stmt=$conn->prepare($sql)){
            $stmt->execute();
            $stmt->bind_result($count);
            while ($stmt->fetch()) {
                $cn=$count;
            }
            if($cn==0){
                $dispo=true;
            }
        }
        //check both
        if($dispo && $inCreneuax){
           
            $sql = "INSERT INTO reservation (Id_S, Date_reserv, Id_C, Statuts,heureDe, heureA) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("isiiss", $Id_S, $Date_reserv, $Id_C, $Statuts,$de,$a);
                if ($stmt->execute()) {
                    echo "nouveau record cree avec succes";
                    $stmt->close();
                    $conn->close();
                } else {
                    echo "Error: " . $stmt->error;
                    $stmt->close();
                    $conn->close();
                }
            } else {
                echo "Error preparing statement: " . $conn->error;
                exit(); 
            }
        }else if(!$dispo){
            echo "Partenaire Non Disponible";
        }else {
            echo "Creneaux non disponible";
        }
    } else {
        header('Location: http://localhost/Bricolini/Views/Authentification/login.php');
        exit();
    
    }
}
?>
