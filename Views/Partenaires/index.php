<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="http://localhost/Bricolini/Views/public/js/Functions.js"></script>
    <title>Profile</title>
</head>
<body>
<?php
require("Views/Components/Nav.php");
?>
<section class="sec">
    <?php require('Views/Components/Reclam.php') ?>
    <div class="informations">
        <div class="image">
            <img src="http://localhost/Bricolini/Views/public/images/<?= $profile['image'] ?>"/>
        </div>
        <div class="field">
            <div class="gen">
                <div>
                    <p><span>Nom:</span> <?= $profile['LastName'] ?></p>
                </div>
                <div>
                    <p><span>Prénom:</span> <?= $profile['FirstName'] ?></p>
                </div>
                <div>
                    <p><span>Profession:</span> <?= $profile['Metier'] ?></p>
                </div>
                <div>
                    <p><span>Ville:</span> <?= $profile['Ville'] ?></p>
                </div>
                <div>
                    <p><span>Années d'expérience:</span> <?= $profile['YearExperience'] ?> Ans</p>
                </div>
                <div>
                    <p><span>Note:</span>
                        <?php
                        for ($i = 0; $i < $profile['Note']; $i++) {
                            echo "&#9733;";
                            // This is the HTML entity for a star
                            //write the number of stars according to the note between 1 and 5

                        }
                        for ($i = $profile['Note']; $i < 5; $i++) {
                            echo "&#9734;"; // This is the HTML entity for an empty star

                        }
                        ?>
                    </p>
                </div>
                <div>
                    <p><span>Nombre de commandes: </span> <?= $profile['Nbr_commande'] ?> Commandes</p>
                </div>
                <div>
                    <p><span>E-mail: </span> <?= $profile['Email'] ?></p>
                </div>
                <div>
                    <p><span>Téléphone: </span> <?= $profile['Telephone'] ?></p>
                </div>
            </div> 
            <div class="cr"> 
                <div><span>Creneaux:</span><br></br></div>
                <div>
                <?php
                $new_creneaux = explode("/", $profile['Creneaux']);
                foreach($new_creneaux as $creneaux){
                    $parts = explode(":", $creneaux);
                    if(count($parts) == 2) {
                        $day = $parts[0];
                        $time_parts = explode("-", $parts[1]);
                        if(count($time_parts) == 2) {
                            $from = $time_parts[0];
                            $to = $time_parts[1];
                            switch($day){
                                case "Monday":
                                    $day="Lundi";
                                    break;
                                case "Tuesday":
                                    $day="Mardi";
                                    break;
                                case "Thursday":
                                    $day="Jeudi";
                                    break;
                                case "Wednesday":
                                    $day="Mercredi";
                                    break;
                                case "Friday":
                                    $day="Vendredi";
                                    break;
                                case "Saturday":
                                    $day="Samedi";
                                    break;
                                case "Sunday":
                                    $day="Dimanche";
                                    break;
                            }
                            echo "<p> ".$day." De : ".$from."h à ".$to."h</p>";
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
    

        <div class="edit">
            <?php
            if ($islogged && !strcmp($type, "partenaire"))
                echo "<a href='http://localhost/Bricolini/Partenaires/updateprofile/" . $profile['id'] . "' style='color: white'><i class='fa-solid fa-pen-to-square fa-xl'></i></a>";
            else
                echo "<i class='fa-solid fa-flag fa-xl' onClick=\"showReclam(" . $_SESSION['user_id'] . ",'client','profile','" . $profile['id'] . "')\"></i>";
            ?>
        </div>
    </div>
    </div>
    <div class="reservationsWrapper">
        <h1>Sevices :</h1>
        <div class="reservations">
            <?php
            foreach ($services as $service) {
                $status = "";
                $service['Note'] ? $status = "Faite" : $status = "En Attente";
                $color = "white"; // Change color to white
                // Get the path of the image
                if ($service['image']) {
                    $image = 'http://localhost/Bricolini/Views/public/images/' . $service['image'];
                } else {
                    if ($service['categorie'] == 'jardennage') {
                        $image = 'http://localhost/Bricolini/Views/public/servicePic/jardennageDefault.jpg';
                    } else {
                        $image = 'http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg';
                    }
}
                if($service['Nbr_commande'] == null){
                    $service['Nbr_commande'] = 0;
                }
                if($service['Note']!=null){
                    $fullStars = round($service['Note']);
                    $halfStar = ($service['Note'] - $fullStars) >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars ;

                    $stars = "<div style='color:$color'>";
                    for ($i = 0; $i < $fullStars; $i++) {
                        $stars .= "&#9733;"; // Full star
                    }
                    if ($halfStar) {
                        $stars .= "&#189;"; // Half star
                    }
                    for ($i = 0; $i < $emptyStars; $i++) {
                        $stars .= "&#9734;"; // Empty star
                    }
                    $stars .= "</div>";
                }else{
                    $stars="<div  style='color:$color'></div>";
                }
                echo "
        <div class='reservationCard'>
            <div class='image'>
                <img src='$image'>
            </div>
            <div class='nameOfservice'>
                <h1>{$service['Nom']}</h1>
                <p>{$service['Description']}</p>
            </div>
            <div class='additional'>
                <div>
                    <p>Prix: {$service['Prix']}</p>
                </div>
                <div>
                    <p style='color:$color'>$stars</p>
                </div>
                <div>
                    <p>Nombre de commandes: {$service['Nbr_commande']}</p>
                </div>";
                if($islogged && !strcmp($type, "partenaire")){
                    echo "
                 <div class='DeleteService'>
                    <button onclick='deleteService({$service['id']})' style='background-color:transparent;border:none'><i class='fa-solid fa-trash fa-xl'></i></a>
                </div>";
                }
                echo "
            </div>
               
            
        </div> ";
            }
            ?>
            <?php
            if (count($services) < 3 && $islogged && !strcmp($type, "partenaire")) {
                echo "
        <div class='reservationCard allRes'>
            <a id='addService' href='http://localhost/Bricolini/Partenaires/addservice/$profile[id]' style='color:white'><p>Ajouter un service
                <i class='fa-solid fa-plus fa-xl'></i></p></a>
        </div>";
            }
            ?>
        </div>
    </div>
    <?php
    if ($islogged && !strcmp($type, "partenaire")) {
        echo "
    <div class='reservationsWrapper'>
        <h1>Commandes :</h1>
        <div class='reservations'>
            ";
        foreach ($commandes as $commande) {
            $status = '';
            switch ($commande['Statuts']) {
                case 0:
                    $status = "En Attente";
                    $color = "gray";
                    break;
                case 1:
                    $status = "Accepté";
                    $color = "lightgreen";
                    break;
                case 2:
                    $status = "Refusé";
                    $color = "red";
                    break;
                case 3:
                    $status = "Faite";
                    $color = "#65B741";
                    break;
            }
            echo "
        <div class='reservationCard'>
            <div class='image'>
                <img src='http://localhost/Bricolini/Views/public/images/{$commande['image']}'>
            </div>
            <div class='nameOfservice'>
                <h1>{$commande['Nom']}</h1> 
                <p>pour : {$commande['FirstName']} {$commande['LastName']}</p> 
            </div>
            <div class='additional'>
                <div>
                    <p> {$commande['Date_reserv']}</p>
                </div>
                <div>
                    <p style='color:$color'>$status</p>
                </div>   
            </div>
        </div> ";
        }
        echo "
            <div class='reservationCard allRes'>
                <a href='http://localhost/Bricolini/Partenaires/interventions' style='color:white'><i
                            class='fa-solid fa-ellipsis fa-xl'></i></a>
            </div>
        </div>
    </div>";
    }
    ?>
    <div class="commentaire">
        <h1 style="color:#FFB534">Commentaire :</h1>
        <div class="commentaires">
            <?php
            $counter = 0;
            if(sizeof($commentaires)!=0){
                foreach ($commentaires as $commentaire) {
                    if ($counter == 5) {
                        break;
                    }
                    if($islogged){
                    echo "
                        <div class='commentaireCard'>
                            <div class='mess'>
                                <h1>{$commentaire['Nom']}</h1>
                                <p class='msg'>{$commentaire['message']}</p>
                            </div>
                            <div class='rat'>
                                <p class='note'>{$commentaire['Rating']}/5</p>
                                <p class='date'>{$commentaire['Date_post']}</p>
                                <p class='report' onclick=\"showReclam(".$_SESSION["user_id"].",'".$type."','commentaire',".$commentaire['id'].")\"><i class='fa-solid fa-flag fa-lg'></i></p>
                            </div>
                        </div>";
                    }else{
                    echo "
                        <div class='commentaireCard'>
                            <div class='mess'>
                                <h1>{$commentaire['Nom']}</h1>
                                <p class='msg'>{$commentaire['message']}</p>
                            </div>
                            <div class='rat'>
                                <p class='note'>{$commentaire['Rating']}/5</p>
                                <p class='date'>{$commentaire['Date_post']}</p>
                            </div>
                        </div>";
                    }
                    $counter++;
                }
            }else{
                echo "<p class='aucune'>Pas de commentaire pour le moment.</p>";
            }
            ?>
        </div>
        <?php
         if($islogged && !strcmp($type, "partenaire")){
            echo"
        <a href='http://localhost/Bricolini/Partenaires/commentaires/0/DESC' style='color:white'><p class='allComments'>
                Voir Plus <i class='fa-solid fa-arrow-right'></i></p></a></div>";
         }
        ?>
</section>
<?php
require("Views/Components/Footer.php");
?>
</body>
</html>
<style>

.field{
    display:flex;
    padding: 15px;
}
.field .gen{
    flex:0 0 50%;
    display: flex;
    flex-direction:column;
    gap:0
}
.field .gen div{
    margin-bottom:10px
}
.field .cr{
    padding-top:25px;
    width:50%;
    border-left:solid 3px var(--green);
}
.field .cr div{
    margin-left:10%
}
.field .cr p{
    margin-left:15%;
    margin-bottom:15px;
}
 .field p{
    font-family:var(--fontSmall);
    font-size: 20px;
    color: var(--white);
}
 .field span{
    font-family:var(--fontBig);
    font-size: 22px;
    color: rgb(70,70,70);
    font-style:italic
}
    .DeleteService button i {
    /* Add your styles here */
    font-size: 20px;
    transition: transform 0.3s ease;
        top: -20px;
        color: red;

}

.DeleteService button:hover i {
    transform: scale(1.5);
    color: darkred;
}
.reservationCard {
    position: relative;
}

.DeleteService {
    position: absolute;
    bottom: -10px;
    right: -10px;
    /*  add a circle around the icon */
    background-color: var(--lightGreen);
    border-radius: 50%;
    padding: 13px;

}
.aucune{
    width:50%;
    margin-left:25%;
    text-align:center;
    padding: 10px;
    font-family:var(--fontSmall);
    font-size:25px;
    background-color:var(--orange);
    border-radius:15px;
    margin-top:25px;
    margin-bottom:25px;
    color:white;
}
</style>
<script>
    function deleteService(id) {
        const message = "Êtes-vous sûr de vouloir supprimer ce service? \n Cette action ne peut pas être annulée";
        if (confirm(message)) {
            window.location.href = "http://localhost/Bricolini/Partenaires/deleteservice/" + id;
        }
    }
</script>




