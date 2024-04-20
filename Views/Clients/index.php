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
        require('Views/Components/Nav.php');
    ?>
    <section class="sec">
        <div class="informations">
            <div class="image">
                <img src="Views/public/clientPic/icon-admin.png"/>
            </div>
            <div class="fields">
                <div> 
                    <p><span>Nom:</span> <?= $profile->infos->LastName?></p>
                </div>
                <div> 
                    <p><span>Prenom:</span>  <?= $profile->infos->FirstName?></p>
                </div>
                <div> 
                    <p><span>Telephone:</span>  <?= $profile->infos->Telephone?></p>
                </div>
                <div> 
                    <p><span>Adresse:</span>  <?= $profile->infos->Address?></p>
                </div> 
            </div>
            <div class="edit">
                <a href="Clients/editProfile" style="color:white"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
            </div>
        </div>
        <div class="reservationsWrapper">
            <h1>Commandes :</h1>
            <div class="reservations">
                <?php
                foreach($profile->commandes as $commande){
                    $status="";
                    $commande->Statuts?$status="Faite":$status="En Attente";
                    $commande->Statuts?$color="#65B741":$color="gray";
                    echo "
                    <div class='reservationCard'>
                        <div class='image'>
                            <img src='Views/public/servicePic/menageDefault.jpg'>
                        </div>
                        <div class='nameOfservice'>
                            <h1>$commande->Nom</h1>
                            <p>par : $commande->FirstName $commande->LastName</p>
                        </div>
                        <div class='additional'>
                            <div>
                                <p> $commande->Date_reserv</p>
                            </div>
                            <div>
                                <p style='color:$color'>$status</p>
                            </div>   
                        </div>
                    </div> ";
                }
                ?>
                <div class="reservationCard allRes">
                    <a href="http://localhost/Bricolini/Clients/getAllCommandes/Tous/3/DESC" style="color:white"><i class="fa-solid fa-ellipsis fa-xl"></i></a>
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
            <a href="http://localhost/Bricolini/Clients/getAllComments/0/DESC" style="color:white"><p class="allComments">Voir Plus <i class="fa-solid fa-arrow-right"></i></p></a>        </div>
    </section>
    <?php
         require("Views/Components/Footer.php");
    ?>
</body>
</html>


