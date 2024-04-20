<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="http://localhost/Bricolini/Views/public/js/Clients.js"></script>
    <title>Commandes Client</title>
</head>
<body>
    <?php
        require("Views/Components/Nav.php");
    ?>
    <section class="sec">
        <div class="commande">
            <div class="search">
                <div>
                    <select name="type" id="type">
                        <option value="Tous" default>Menage & Jardinage</option>
                        <option value="menage" default>Menage</option>
                        <option value="jardinage">Jardinage</option>
                    </select>
                </div>
                <div>
                    <select name="status" id="status">
                        <option value=3 default>Tous</option>
                        <option value=1 default>Faite</option>
                        <option value=0>En Attente</option>
                    </select>
                </div>
                <div>
                    <select name="sort" id="sort">
                        <option value="DESC" default>Plus Recent</option>
                        <option value="ASC">Plus Ancien</option>
                    </select>
                </div>
                <div>
                    <button onClick="getSearchparm()">OK</button>
                </div>
            </div>
            <div class="commandesAll">
            <?php
                if(count($profile->commandes)!=0){
                    foreach($profile->commandes as $commande){
                        $status="";
                        $commande->Statuts?$status="Faite":$status="En Attente";
                        $commande->Statuts?$color="#65B741":$color="gray";
                        echo "
                        <div class='reservationCard'>
                            <div class='image'>
                                <img src='http://localhost/Bricolini/Views/public/servicePic/menageDefault.jpg'>
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
                }else{
                    echo "<div></div><p class='err'>Pas De Commandes</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
        require("Views/Components/Footer.php");
    ?>
</body>
</html>