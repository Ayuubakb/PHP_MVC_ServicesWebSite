<?php
require_once 'Models/Partenaire.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $partenaire = new Partenaire();
    $partenaire->updateStatus($id, $status);

    echo "Status updated successfully";
}
?>