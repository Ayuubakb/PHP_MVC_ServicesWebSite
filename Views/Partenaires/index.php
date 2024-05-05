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
                } // Use a default image if none is provided
                //    // Check if the image file exists and is readable
                //    if (is_readable($image)){
                //        // If the image file exists and is readable, use it
                //        $image = 'http://localhost/Bricolini/Views/public/images/'.$service['image'];
                //    }else {
                //        // If the image file does not exist or is not readable, use a default image based on the service category
                //        if ($service['categorie'] == 'jardennage') {
                //            $image = 'http://localhost/Bricolini/Views/public/servicePic/jardennageDefault.jpg';
                //        } else if ($service['categorie'] == 'menage') {
                //            $image = 'http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg';
                //        } else {
                //            // If the service category is not recognized, use a general default image
                //            $image = 'http://localhost/Bricolini/Views/public/servicePic/jardinageDefault.jpg';
                //        }
                //    }

                $fullStars = floor($service['Note']);
                $halfStar = ($service['Note'] - $fullStars) >= 0.5 ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;

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
            </div>
        </div> ";
            }
            ?>
            <?php
            if (count($services) < 3 && $islogged && !strcmp($type, "partenaire")) {
                echo "
        <div class='reservationCard allRes'>
            <a href='http://localhost/Bricolini/Partenaires/addservice/$profile[id]' style='color:white'><p>Add Service
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


