<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <title>Interactions</title>
    </title>
</head>
<body>
<?php
require __DIR__ . "/../Components/Nav.php";
?>
<div class="Traitement">
    <h1>Waiting : </h1>
    <?php foreach ($commandesnontraitees as $commande): ?>
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
    <div class="reservationsWrapper">
        <h1>Commandes :</h1>
        <div class="reservations">
            <?php // Debugging
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
    echo "
        <div class='reservationCard'>
            <div class='image'>
                <img src='http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg'/>
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
?>

</section>
<?php
require __DIR__ . "/../Components/Footer.php";
?>
</body>
</html>
<style>
    .commande {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: var(--yellow);
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
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
    width: 70%;
    margin: auto;
    margin-top: 50px;
/*
*/
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

            
            var confirmAction = confirm("Est ce que vous etes sure de votre choix?\nCette action est irreversible.");
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
        });
    });
</script>