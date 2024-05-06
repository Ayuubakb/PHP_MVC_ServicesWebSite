<?php
session_start();
require("../Services/connexion.php");
$firstName=$_POST['firstName'];
$LastName=$_POST['lastName'];
$Address=$_POST['address'];
$Telephone=$_POST['telephone'];
$id=$_SESSION['user_id'];
if($_FILES["pic"]["size"] == 0){
    $objct=new stdClass();
    $sql="UPDATE client SET 
                LastName='$LastName', FirstName='$firstName', Address='$Address', Telephone='$Telephone'
                WHERE id=$id";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $objct->msg="Données Modifiés";
    echo json_encode($objct);
 }else{
    $imgName="imageClient".$id.".".pathinfo(basename($_FILES["pic"]["name"]),PATHINFO_EXTENSION);
    $target_dir = "../public/images/";
    $target_file = $target_dir . $imgName;
    
    $uploadOk = 1;
    
    if ($uploadOk == 0) {
       $updated=false;
    } else {
       if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            $objct=new stdClass();
            $sql="UPDATE client SET 
                LastName='$LastName', FirstName='$firstName', Address='$Address', Telephone='$Telephone', image='$imgName'
                WHERE id=$id";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $objct->img=$imgName;
            $objct->msg="Données Modifiés";
            echo json_encode($objct);
       } else {
            $objct=new stdClass();
            $objct->msg="Erreur";
            echo json_encode($objct);
       }
    }
 }