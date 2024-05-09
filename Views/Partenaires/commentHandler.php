<?php
require("../Services/connexion.php");

$rating = $_POST['rating'];
$comment = $_POST['comment'];
$idRes = $_POST['idRes'];
$type = $_POST['user_type'];
$date = date("Y-m-d");
$sql = "INSERT INTO commentaire (message,Rating,Date_post,publisher,published,Id_R) 
                VALUES ('$comment',$rating,'$date','$type',0,$idRes)";
        if($stmt=$conn->prepare($sql)){
            $stmt->execute();
            echo "Commentaire Ajoute";
        }
        
        $sql="SELECT avg(Rating),id_S FROM commentaire c
            INNER JOIN reservation r ON r.id=c.Id_R
            WHERE r.id='$idRes'  and r.statuts = 3
            and c.publisher='client'
        ";
if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $stmt->bind_result($new_avg, $id_S);
    while ($stmt->fetch()) {
        $newAvg = $new_avg;
        $idS = $id_S;
    }
    if (isset($newAvg) && isset($idS)) {
        $sql = "UPDATE services set Note=$newAvg WHERE id=$idS";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
        }
        $sql="SELECT avg(Note),Id_P FROM services s
            WHERE Id_P=(SELECT Id_P From services WHERE id=(select Id_S FROM reservation WHERE id=$idRes))";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($new_avg, $id_P);
            while ($stmt->fetch()) {
                $newAvg = $new_avg;
                $idP = $id_P;
            }
            if (isset($newAvg) && isset($idP)) {
                $sql = "UPDATE partenaire set Note=$newAvg WHERE id=$idP";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->execute();
                }
            }
        }
    }
}