<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Interventions</title>
    </title>
</head>
<body>
<?php
require __DIR__ . "/../Components/Nav.php";
?>
<div class="Traitement">
    <h1>En Attente : </h1>
    <?php
    if(count($commandesnontraitees) == 0) {
        echo "<p class='aucune'>Aucune Commande en attente.</p>";
    }
    foreach ($commandesnontraitees as $commande): ?>
        <div class='commande'>
            <h2>Commande: <?= $commande['ID_reserv'] ?></h2>
            <p>Service: <?= $commande['Nom'] ?></p>
            <p>Date: <?= $commande['Date_reserv'] ?></p>
            <p>Client: <?= $commande['FirstName'] ?> <?= $commande['LastName'] ?></p>
            <button class='accept' data-id='<?= $commande['ID_reserv'] ?>'>Accepter</button>
            <button class='refuse' data-id='<?= $commande['ID_reserv'] ?>'>Refuser</button>
        </div>
    <?php endforeach; ?>
</div>

<section class="sec">
    <div class="commande">
        <h1>Commandes :</h1>
        <div class="commandesAll">
            <?php // Debugging
            if(count($interventions) == 0) {
                echo "<h2 class='aucune' style='color:white;'>Aucune Commande Acceptée.</h2>";
            }
    foreach ($interventions as $commande) {
        $status = "";
                $status="";
                switch ($commande['Statuts']){
                    case 0:
                        $status="En Attente";
                        $color="gray";
                        break;
                    case 1:
                        $status="Accepté";
                        $color="lightgreen";
                        break;
                    case 2:
                        $status="Refusé";
                        $color="red";
                        break;
                    case 3:
                        $status="Faite";
                        $color="#65B741";
                        break;
                }
    //            show only the accepted or refused commands
                if($commande['Statuts']==1){
                    echo "
            <div class='reservationCard'>
                <div class='image'>
                    <img src='http://localhost/Bricolini/Views/public/images/{$commande['image']}'/>
                </div>
                <div class='nameOfservice'>
                    <h1>{$commande['Nom']}</h1> 
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
    }
?>

</section>
<?php
require __DIR__ . "/../Components/Footer.php";
?>
</body>
</html>
<style>
  
.commande h1{
    width:85%;
    margin-left:7.5%
}
.commande h2 {
    margin-top: 0;
    color: var(--green);
    text-align: center;
}

.commande p {
    color: #666;
    margin: 10px 20px;
}

.accept, .refuse {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 10px;
    margin-right: 10px;
    text-align: center;
}

.accept {
    background-color: #4CAF50;
    color: white;
}

.refuse {
    background-color: #f44336;
    color: white;
}
.Traitement{
/*    make the div 70 % of the page and center it */
    width: 85%;
    margin-left: 7.5%;
    margin-top: 50px;
    min-height:250px;
/*
*/
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
    margin-top:75px;
    color:white;
}
h1{
    margin-bottom: 9px;
    font-size: 25px;
    font-family: var(--fontBig);
    font-size: 35px;
    color: #65B741;
}
</style>
<script>
    $(document).ready(function() {
        $('button.accept, button.refuse').on('click', function(e) {
            e.preventDefault();

            
            var confirmAction = confirm("Êtes-vous sûr(e) de votre choix ?\n Cette action est irréversible.");
            if (!confirmAction) {
                return; 
            }

            var id = $(this).data('id');
            var status = $(this).hasClass('accept') ? 1 : 2; 

            $.ajax({
                url: 'http://localhost/Bricolini/Partenaires/updateStatus', 
                method: 'POST',
                data: { id: id, status: status },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    alert('Error updating status. Please try again.');
                }
            });
            //send the mail with the infos about the Client to the partner
            if(status==1){
                $.ajax({
                    url: 'http://localhost/Bricolini/Partenaires/sendMail',
                    method: 'POST',
                    data: { id: id},
                    success: function(response) {
                        console.log(response);
                        //reload the page

                    },
                    error: function() {
                        alert('Error sending mail. Please try again.');
                    }
                });
            }
        });
    });
</script>