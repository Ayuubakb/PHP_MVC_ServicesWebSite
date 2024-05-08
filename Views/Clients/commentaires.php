
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="http://localhost/Bricolini/Views/public/js/Clients.js"></script>
    <script src="http://localhost/Bricolini/Views/public/js/Functions.js"></script>
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Commentaires</title>
</head>
<body>
    <?php
        require("Views/Components/Nav.php");
    ?>
    <section class="sec">
    <?php require('Views/Components/Reclam.php') ?>
        <div class="comments">
            <div class="search" style="color:#65B741">
                <div>
                    <select name="rating" id="rating">
                        <option value=0 default>Tous</option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select>
                </div>
                <div>
                    <select name="sort" id="sort">
                        <option value="DESC" default>Plus Recent</option>
                        <option value="ASC">Plus Ancien</option>
                    </select>
                </div>
                <div>
                    <button onClick="getSearchparm2()">Chercher</button>
                </div>
            </div>
            <div class="commandesAll">
            <?php
                if(count($profile->commentaire)!=0){
                    foreach($profile->commentaire as $commentaire){
                        if($commentaire->rating > 3){
                            $color="green";
                        }else if($commentaire->rating=3){
                            $color="orange";
                        }else{
                            $color="red";
                        }
                        echo "
                        <div class='commentaireCard'>
                            <div class='mess'>
                                <h1>$commentaire->fn  $commentaire->ln</h1>
                                <p  class='title'>$commentaire->nom</p>
                                <p  class='msg'>$commentaire->message</p>
                            </div> 
                            <div class='rat'>
                                <p class='note' style='color:$color'>$commentaire->rating/5</p>
                                <p class='date'>$commentaire->datePost</p>
                                <p class='report' onclick=\"showReclam(".$_SESSION["user_id"].",'".$type."','commentaire',".$commentaire->id.")\"><i class='fa-solid fa-flag fa-lg'></i></p>
                            </div> 
                        </div> ";
                    }
                }else{
                    echo "<p class='err'>Pas De Commentaires</p>";
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
<style>
    .err{
        margin-left:25%;
        width:50%;
        margin-top:15%;
        padding: 10px;
        background-color:var(--orange);
        border-radius:10px;
        text-align:center;
        font-family:var(--fontBig);
        font-size:28px;
        color:white
    }
</style>