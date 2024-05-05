<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Interactions</title>
    </title>
</head>
<body>
<?php
require __DIR__ . "/../Components/Nav.php";
//print_r($notcommented);
$commented = array_filter($historique, function($element) use ($notcommented) {
    return !in_array($element, $notcommented);
});
?>
<section class="sec">
    <div class="search">
        <div>
            <select name="status" id="status">
                <option value=4 default>Tous</option>
                <option value=0>En Attente</option>
                <option value=1>Accepté</option>
                <option value=2 default>Refusé</option>
                <option value=3 default>Faite</option>
            </select>
        </div>
        <div>
            <select name="sort" id="sort">
                <option value="DESC" default>Plus Recent</option>
                <option value="ASC">Plus Ancien</option>
            </select>
        </div>
        <div>
            <button onClick="function Historique() {
                var status = document.getElementById('status').value;
                var sort = document.getElementById('sort').value;
                window.location.href = 'http://localhost/Bricolini/Partenaires/Historique/' + status + '/' + sort;
            }
            Historique()">OK</button>
        </div>
    </div>
    <div class="reservationsWrapper">
        <h1>Commandes :</h1>
        <div class="reservations">

            <?php // Debugging
            foreach ($historique as $commande) {
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
                if($commande['Statuts']!=0){
                    echo "
        <div class='reservationCard'>
            <div class='image'>";
                    echo "<img src='http://localhost/Bricolini/Views/public/images/{$commande['image']}' alt=''>";

            echo "</div>
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
                </div>   ";
                if (!in_array($commande, $commented) && $commande['Statuts'] == 3) {
                    echo "
                <div class='icon_div'>
                    <button onClick=\"showCommentForm({$commande['id']})\"><i class='fas fa-comment'></i></button>
                </div>";
                        }
                        echo "
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
    .reservationCard {
    position: relative;
}

.icon_div {
    position: absolute;
    right: 10px;
    bottom: 10px;
}

.icon_div button {
    background: none;
    border: none;
    color: #3584ed;
    font-size: 2em;
    cursor: pointer;
    padding: 8px;
}
}
</style>



