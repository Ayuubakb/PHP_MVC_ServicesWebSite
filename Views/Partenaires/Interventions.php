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
require("navbar.php");
?>
<div class="Traitement">
    <h1>Waiting : </h1>
    <?php
foreach ($commandesnontraitees as $commande) {
    echo "
    <form id='form-{$commande['ID_reserv']}' method='post' class='ajax-form'>
        <div class='commande'>
            <p style='display:none'>{$commande['ID_reserv']}</p>
            <h2>Commande: {$commande['ID_reserv']}</h2>
            <p>Service: {$commande['Nom']}</p>
            <p>Date: {$commande['Date_reserv']}</p>
            <p>Client: {$commande['FirstName']} {$commande['LastName']}</p>
            <button class='accept'>Accepter</button>
            <button class='refuse'>Refuser</button>
        </div>
    </form>
    ";
}
?>
</div>
<section class="sec">
    <div class="reservationsWrapper">
        <h1>Commandes :</h1>
        <div class="reservations">
            <?php // Debugging
foreach ($interventions as $commande) {
    $status = "";
    $commande['Statuts'] ? $status = "Faite" : $status = "En Attente";
    $commande['Statuts'] ? $color = "#65B741" : $color = "gray";
    echo "
        <div class='reservationCard'>
            <div class='image'>
                <img src='http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg'/>
            </div>
            <div class='nameOfservice'>
                <h1>{$commande['Nom']}</h1> 
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

</section>
<?php
require("Views/Components/Footer.php");
?>
</body>
</html>
<style>
    .commande {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}

.commande h2 {
    margin-top: 0;
    color: #333;
}

.commande p {
    color: #666;
    margin: 10px 0;
}

.accept, .refuse {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 10px;
}

.accept {
    background-color: #4CAF50;
    color: white;
}

.refuse {
    background-color: #f44336;
    color: white;
}
</style>

<script>
    $(document).ready(function() {
    $('.ajax-form button').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('ajax-form');
        var id = form.find('p').text();
        var status = $(this).hasClass('accept') ? 1 : 2;
        $.ajax({
            url: 'http://localhost/Bricolini/Views/Partenaires/updateStatus.php',
            method: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
                form.remove();
            }
        });
});
</script>