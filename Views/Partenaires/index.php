<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <title>Profile</title>
</head>
<body>
<?php
require('navbar.php');
?>
<section class="sec">
    <div class="informations">
        <div class="image">
            <img src="Views/public/clientPic/icon-admin.png"/>
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
            <a href="Partenaires/updateprofile" style="color: white" ><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
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
    $image = $service['image'] ? 'Views/public/images/'.$service['image'] : 'Views/public/servicePic/menageDefault.jpg'; // Use a default image if none is provided

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
if (count($services) < 3) {
        echo "
        <div class='reservationCard allRes'>
            <a href='http://localhost/Bricolini/Partenaires/addservice' style='color:white'><p>
                <i class='fa-solid fa-plus fa-xl'></i></p></a>
        </div>";
}
?>
        </div>
</div>
    <div class="reservationsWrapper">
        <h1>Commandes :</h1>
        <div class="reservations">
            <?php // Debugging
foreach ($commandes as $commande) {
    $status = "";
    $commande['Statuts'] ? $status = "Faite" : $status = "En Attente";
    $commande['Statuts'] ? $color = "#65B741" : $color = "gray";
    echo "
        <div class='reservationCard'>
            <div class='image'>
                <img src='Views/public/servicePic/menageDefault.jpg'>
            </div>
            <div class='nameOfservice'>
                <h1>{$commande['Nom']}</h1> <!-- Assuming 'id' is the name of the service -->
                <p>par : {$commande['FirstName']} {$commande['LastName']}</p> <!-- Now using the client's first and last names -->
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
?>
            <div class="reservationCard allRes">
                <a href="http://localhost/Bricolini/Partenaires/interventions" style="color:white"><i
                            class="fa-solid fa-ellipsis fa-xl"></i></a>
            </div>
        </div>
    </div>
    <div class="commentaire">
        <h1 style="color:#FFB534">Commentaire :</h1>
        <div class="commentaires">
            <div class="commentaireCard">
                <div class="mess">
                    <h1>Nettoyage Genaral</h1>
                    <p>Bon Client</p>
                </div>
                <div class="rat">
                    <p class="note">3/5</p>
                    <p class="date">28/11/2023</p>
                </div>
            </div>
            <div class="commentaireCard">
                <div class="mess">
                    <h1>Nettoyage Genaral</h1>
                    <p>Bon Client</p>
                </div>
                <div class="rat">
                    <p class="note">3/5</p>
                    <p class="date">28/11/2023</p>
                </div>
            </div>
            <div class="commentaireCard">
                <div class="mess">
                    <h1>Nettoyage Genaral</h1>
                    <p>Bon Client</p>
                </div>
                <div class="rat">
                    <p class="note">3/5</p>
                    <p class="date">28/11/2023</p>
                </div>
            </div>
            <div class="commentaireCard">
                <div class="mess">
                    <h1>Nettoyage Genaral</h1>
                    <p>Bon Client</p>
                </div>
                <div class="rat">
                    <p class="note">3/5</p>
                    <p class="date">28/11/2023</p>
                </div>
            </div>
            <div class="commentaireCard">
                <div class="mess">
                    <h1>Nettoyage Genaral</h1>
                    <p>Bon Client</p>
                </div>
                <div class="rat">
                    <p class="note">3/5</p>
                    <p class="date">28/11/2023</p>
                </div>
            </div>
        </div>
        <a href="http://localhost/Bricolini/Partenaires/commentaires/0/DESC" style="color:white"><p class="allComments">
                Voir Plus <i class="fa-solid fa-arrow-right"></i></p></a></div>
</section>
<?php
require("Views/Components/Footer.php");
?>
</body>
</html>


