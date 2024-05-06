<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$userId = $_POST['id'];
$serviceName = $_POST['serviceName'];
$serviceDescription = $_POST['serviceDescription'];
$servicePrice = $_POST['servicePrice'];
$serviceCategory = $_POST['serviceCategory'];
$servicesousCategory = $_POST['servicesousCategory'];

if (isset($_FILES['serviceImage']) && $_FILES['serviceImage']['error'] == 0 ) {
    
} else {
    $serviceImage = "";
}
if ($serviceImage == "") {
    switch (strtolower($servicesousCategory)) {
        case strtolower("Nettoyage de canapés"):
            $serviceImage = "nettoyage_canap.webp";
            break;
        case strtolower("Nettoyage des surfaces"):
            $serviceImage = "nettoyage_surfaces.webp";
            break;
        case strtolower("Nettoyage général"):
            $serviceImage = "nettoyage_g.webp";
            break;
        case strtolower("Entretien de Gazon et Pelouse"):
            $serviceImage = "plantation_gazon_pelouse.webp";
            break;
        case strtolower("Traitement de jardin"):
            $serviceImage = "traitementjardin.webp";
            break;
        case strtolower("Plantation pour jardin"):
            $serviceImage = "plantationjardin.webp";
            break;
    }
}

// Insert data into database
$query = $conn->prepare("INSERT INTO services (Id_P,Nom , Description,Prix , categorie, sousCategorie, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
$result = $query->execute([$userId, $serviceName, $serviceDescription, $servicePrice, $serviceCategory, $servicesousCategory, $serviceImage]);

if ($result) {
    // Redirect to success page
//    header("Location: http://localhost/Bricolini/Partenaires/index/" . $_SESSION['user_id']);
    print_r($result);
    echo "Service added successfully";
    //print all the values in the line
    echo "<br>";
    echo "Id_P: " . $userId . "<br>";
    echo "Nom: " . $serviceName . "<br>";
    echo "Description: " . $serviceDescription . "<br>";
    echo "Prix: " . $servicePrice . "<br>";
    echo "categorie: " . $serviceCategory . "<br>";
    echo "sousCategorie: " . $servicesousCategory . "<br>";
    echo "image: " . $serviceImage . "<br>";
    echo "result: " . $result . "<br>";
} else {
    // Handle error
}