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
        <div class='commande Card'>
            <h2>Commande: <?= $commande['ID_reserv'] ?></h2>    
            <div class="infos">
                <p><span class="sp">Service:</span> <?= $commande['Nom'] ?></p>
                <p><span class="sp">Date: </span><?= $commande['Date_reserv'].'( '.$commande['heureDe'].'h <i class="fa-solid fa-arrow-right"></i> '.$commande["heureA"].'h )'  ?></p>
                <p><span class="sp">Client: </span><?= $commande['FirstName'] ?> <?= $commande['LastName'] ?></p>
            </div>
            <div class="btns">
                <button class='accept' data-id='<?= $commande['ID_reserv'] ?>'>Accepter</button>
                <button class='refuse' data-id='<?= $commande['ID_reserv'] ?>'>Refuser</button>
            </div>
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
.Card{
    box-shadow:2px 2px 10px var(--lightGreen);
    padding-top:15px;
    padding-bottom:15px;
    border-radius:25px;
    margin-top:15px;
    margin-bottom:15px
}
.Card .infos{
    width:30%;
    margin-left:35%;
    text-align:center;
    margin-top:15px;
    margin-bottom:15px;
}
.Card .infos p{
    font-family:var(--fontSmall);
    font-size:20px;
    
}
.Card .infos p .sp{
    font-family:var(--fontSmall);
    font-weight:bold;
    color:black;
}
.Card .btns{
    display:flex;
    align-items:center;
    justify-content:space-around;
    width:50%;
    margin-left:25%;
}
.Card .btns button{
    padding: 15px 22px;
    width: 35%;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 10px;
    margin-right: 10px;
    text-align: center;
    font-family:var(--fontBig);
    font-size:18px;
    color:white;
    border-radius:15px
}
.accept{
    background-color:var(--green);
}
.refuse{
    background-color:red;
}
.commande h1{
    width:85%;
    margin-left:7.5%;
}
.commande h2 {
    margin-top: 0;
    color: var(--green);
    text-align: center;
    font-family:var(--fontBig);
    font-size:30px
}
.commande p {
    color: #666;
    margin: 10px 20px;
}
.Traitement{
    width: 85%;
    margin-left: 7.5%;
    margin-top: 50px;
    min-height:250px;
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