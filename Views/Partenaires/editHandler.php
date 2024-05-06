<?php
session_start();
require("../Services/connexion.php");
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
$profile = [
    "id" => $_SESSION['user_id'],
    "FirstName" => $_POST['firstName'],
    "LastName" => $_POST['lastName'],
    "Metier" => $_POST['Metier'],
    "Ville" => $_POST['Ville'],
    "YearExperience" => $_POST['YearExperience'],
    "Email" => $_POST['Email'],
    "Telephone" => $_POST['Telephone'],
    "Creneaux" => $Creneaux
];
$flag=true;
$objct=new stdClass();
$id=$_SESSION['user_id'];
if($_FILES["pic"]["size"] != 0){
    $imgName="imagePartenaire".$id.".".pathinfo(basename($_FILES["pic"]["name"]),PATHINFO_EXTENSION);
    $uploadDir = '../public/images/';
    $uploadFile = $uploadDir . $imgName;    
    $profile['image']=$imgName;
    if(move_uploaded_file($_FILES["pic"]["tmp_name"], $uploadFile)){
        $objct->msg="Données Modifiés";
        $objct->img=$imgName;
    }else{
        $flag=false;
    }
}
if($flag){
    $sql = "UPDATE partenaire SET ";
    foreach ($profile as $key => $value) {
        $sql .= "$key = '$value',";
    }
    $sql = substr($sql, 0, -1);
    $sql .= " WHERE id = $id";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $objct->msg="Données Modifiés";
    echo json_encode($objct);
}else{
    $objct->msg="Erreur";
    echo json_encode($objct);
}


 