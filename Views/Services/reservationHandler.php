
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['user_id'])){
        $Id_S = $_POST['Id_S'];
        $Date_reserv = $_POST['Date_reserv'];
        $Id_C = $_POST['Id_C'];
        $Statuts = $_POST['Statuts'];

<<<<<<< HEAD
    $Id_S = $_POST['Id_S'];
    $Date_reserv = $_POST['Date_reserv'];

    $Id_C = $_POST['Id_C'];
    $Statuts = $_POST['Statuts'];

    $sql = "INSERT INTO reservation (Id_S, Date_reserv, Id_C, Statuts) VALUES (?, ?, ?, ?)";


    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isii", $Id_S, $Date_reserv, $Id_C, $Statuts);
        if ($stmt->execute()) {
            echo "New record created successfully";
=======
        $sql = "INSERT INTO reservation (Id_S, Date_reserv, Id_C, Statuts) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isii", $Id_S, $Date_reserv, $Id_C, $Statuts);
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
>>>>>>> 7f0084180faafa2eb197bc4ff2e4ce4dff0a4c6c
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
        $conn->close();
    }else{
        echo "no";
        //header('Location:http://localhost/Bricolini/Authentification/login');
    }
}
?>
