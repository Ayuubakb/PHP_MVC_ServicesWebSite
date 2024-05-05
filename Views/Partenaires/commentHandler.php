<?php
        require("../Services/connexion.php");

        $rating=$_POST['rating'];
        $comment=$_POST['comment'];
        $idRes=$_POST['idRes'];
        $type=$_POST['user_type'];
        $date=date("Y-m-d");
        
        $sql="INSERT INTO commentaire (message,Rating,Date_post,publisher,published,Id_R) 
                VALUES ('$comment',$rating,'$date','$type',0,$idRes)";
        if($stmt=$conn->prepare($sql)){
            $stmt->execute();
            echo "Commentaire Ajoute";
        }