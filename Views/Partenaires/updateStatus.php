<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        require_once 'Models/Partenaire.php';
        $partenaire = new Partenaire();
        $partenaire->updateStatus($_POST['id'], $_POST['status']);
        echo 'Status updated successfully';
    } else {
        echo 'Missing parameters';
    }
} else {
    echo 'Invalid request';
}
?>