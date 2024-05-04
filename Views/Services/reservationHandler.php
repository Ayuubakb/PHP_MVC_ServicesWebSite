
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Id_S = $_POST['Id_S'];
    $Date_reserv = $_POST['Date_reserv'];

    $Id_C = $_POST['Id_C'];
    $Statuts = $_POST['Statuts'];

    $sql = "INSERT INTO reservation (Id_S, Date_reserv, Id_C, Statuts) VALUES (?, ?, ?, ?)";


    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isii", $Id_S, $Date_reserv, $Id_C, $Statuts);
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
}
?>
