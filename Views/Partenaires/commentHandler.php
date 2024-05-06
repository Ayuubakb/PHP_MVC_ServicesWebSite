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

        $sql="SELECT avg(Rating),id_S FROM commentaire c
            INNER JOIN reservation r ON r.id=c.Id_R
            WHERE r.id='$idRes'  and r.statuts = 3
            and c.publisher='client'
        ";
        if( $stmt=$conn->prepare($sql)){
            $stmt->execute();
            $stmt->bind_result($new_avg,$id_S);
            while($stmt->fetch()){
                $newAvg=$new_avg;
                $idS=$id_S;
            }
        }
        $sql="UPDATE services set Note=$newAvg WHERE id=$idS";
        if($stmt=$conn->prepare($sql)){
            $stmt->execute();
        }
