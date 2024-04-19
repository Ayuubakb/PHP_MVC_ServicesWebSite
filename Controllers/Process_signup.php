<?php
// Configuration de la connexion à la base de données
$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des données du formulaire
$lastName = $_POST['LastName'];
$firstName = $_POST['FirstName'];
$email = $_POST['Email'] ?? null;
$telephone = $_POST['Telephone'] ?? null;
$imagePath = null;

// Traitement de l'image téléchargée
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $uploadDir = 'uploads/';
    $fileName = time() . '_' . basename($_FILES['image']['name']); // Préfixe le nom de fichier avec le timestamp pour éviter les doublons
    $uploadFile = $uploadDir . $fileName;
    
    if (in_array($_FILES['image']['type'], $allowedMimeTypes) && move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $imagePath = $uploadFile;
    } else {
        echo "Erreur lors du téléchargement de l'image ou type de fichier non autorisé.";
    }
}

// Insertion dans la base de données
if (!empty($email)) {
    // Partenaire
    $stmt = $pdo->prepare("INSERT INTO Partenaire (LastName, FirstName, Email, ImagePath) VALUES (?, ?, ?, ?)");
    $stmt->execute([$lastName, $firstName, $email, $imagePath]);
    echo "Inscription du partenaire réussie.";
} elseif (!empty($telephone)) {
    // Client
    $stmt = $pdo->prepare("INSERT INTO client (LastName, FirstName, Telephone, ImagePath) VALUES (?, ?, ?, ?)");
    $stmt->execute([$lastName, $firstName, $telephone, $imagePath]);
    echo "Inscription du client réussie.";
} else {
    echo "Erreur : Type d'utilisateur non spécifié.";
}