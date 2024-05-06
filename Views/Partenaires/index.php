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
        <div class="fields">
            <div>
                <p><span>Last Name:</span> <?= $profile['LastName'] ?></p>
            </div>
            <div>
                <p><span>First Name:</span> <?= $profile['FirstName'] ?></p>
            </div>
            <div>
                <p><span>Profession:</span> <?= $profile['Metier'] ?></p>
            </div>
            <div>
                <p><span>City:</span> <?= $profile['Ville'] ?></p>
            </div>
            <div>
                <p><span>Years of Experience:</span> <?= $profile['YearExperience'] ?></p>
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
                    echo "(" . $profile['Note'] . "/5)";
                    ?>
                </p>
            </div>
            <div>
                <p><span>Number of Commands:</span> <?= $profile['Nbr_commande'] ?></p>
            </div>
            <div>
                <p><span>Email:</span> <?= $profile['Email'] ?></p>
            </div>
            <div>
                <p><span>Telephone:</span> <?= $profile['Telephone'] ?></p>
            </div>
            <div>
    <span>Creneaux:</span>
    <pre>
    <?php
    echo "\n";
    echo "\n";
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
            echo " ".$day." De : ".$from." à ".$to."\n";
        }
    }
}
    ?>
    </pre>
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
                    <p>Price: {$service['Prix']}</p>
                </div>
                <div>
                    <p style='color:$color'>$stars</p>
                </div>
                <div>
                    <p>Number of Commands: {$service['Nbr_commande']}</p>
                </div>
                 <div class='DeleteService'>
                    <button onclick='deleteService({$service['id']})' style='background-color:transparent;border:none'><i class='fa-solid fa-trash fa-xl'></i></a>
                </div>
            </div>
               
            
        </div> ";
            }
            ?>
            <?php
            if (count($services) < 3 && $islogged && !strcmp($type, "partenaire")) {
                echo "
        <div class='reservationCard allRes'>
            <a id='addService' href='http://localhost/Bricolini/Partenaires/addservice/$profile[id]' style='color:white'><p>Add Service
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
                <img src='http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg'>
            </div>
            <div class='nameOfservice'>
                <h1>{$commande['Nom']}</h1> <!-- Assuming 'id' is the name of the service -->
                <p>pour : {$commande['FirstName']} {$commande['LastName']}</p> <!-- Now using the client's first and last names -->
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
            foreach ($commentaires as $commentaire) {
                if ($counter == 5) {
                    break;
                }
                echo "
    <div class='commentaireCard'>
        <div class='mess'>
            <h1>{$commentaire['Nom']}</h1>
            <p>{$commentaire['message']}</p>
        </div>
        <div class='rat'>
            <p class='note'>{$commentaire['Rating']}/5</p>
            <p class='date'>{$commentaire['Date_post']}</p>
        </div>
    </div>";
                $counter++;
            }
            ?>
        </div>
        <a href="http://localhost/Bricolini/Partenaires/commentaires/0/DESC" style="color:white"><p class="allComments">
                Voir Plus <i class="fa-solid fa-arrow-right"></i></p></a></div>
</section>
<?php
require("Views/Components/Footer.php");
?>
</body>
</html>
<style>
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
</style>
<script>
    function deleteService(id) {
        const message = "Are you sure you want to delete this service? \n " +
            "This action cannot be undone.";
        if (confirm(message)) {
            window.location.href = "http://localhost/Bricolini/Partenaires/deleteservice/" + id;
        }
    }
</script>




