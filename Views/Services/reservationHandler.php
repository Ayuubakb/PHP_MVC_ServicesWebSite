<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['user_id'])){
        // print "user_id: ";
        $Id_S = $_POST['Id_S'];
        $Date_reserv = $_POST['Date_reserv'];
        $Id_C = $_SESSION['user_id'];
        $Statuts = $_POST['Statuts'];

        $sql = "INSERT INTO reservation (Id_S, Date_reserv, Id_C, Statuts) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isii", $Id_S, $Date_reserv, $Id_C, $Statuts);
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
            header('Location: http://localhost/Bricolini/Views/Authentification/login.php');
            exit(); 
        }
    } else {
        header('Location: http://localhost/Bricolini/Views/Authentification/login.php');
        exit();
    }
}
?>
