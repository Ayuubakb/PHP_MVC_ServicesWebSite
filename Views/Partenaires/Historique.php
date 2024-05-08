<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Historique</title>
    </title>
</head>
<body>
<?php

require __DIR__ . "/../Components/Nav.php";

?>
<section class="sec">
    <div  class="formComment" id="formComment">
        <form id="formToSend">
            <div class="close" onclick="hideForm()">
                <i class="fa-solid fa-xmark "></i>
            </div>
            <h1>Ajouter un commentaire</h1>
            <p id="err" class="err"></p>
            <div>
                <input type="hidden" id="typeUser" value="<?= $_SESSION["user_type"] ?>"/>
                <input type="hidden" id="resId" />
                <label>Evaluation : </label>
                <select name="rating" required id="rating">
                    <option value=0>0</option>
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3 selected>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select>
            </div>
            <div>
                <label>Commentaire :</label>
                <textarea name="comment" required id="commentText"></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
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
            Historique()">Rechercher</button>
        </div>
    </div>
    <div class="commande">
        <div class="commandesAll">

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
                if ($commande['Statuts'] == 3 && !in_array($commande['id'],$commented)) {
                    echo "
                <div class='comment'>
                    <button onclick=\"showCommentForm({$commande[0]})\"><i class='fas fa-comment fa-lg'></i></button>
                </div>";
                        }
                        echo "
            </div>
        </div> ";
                    }
            }
            ?>

</section>
<script>
    function showCommentForm(id) {
        document.getElementById('formComment').style.display='block';
        document.getElementById('resId').value=id;
    }
    function hideForm() {
        document.getElementById('formComment').style.display='none';
    }
    document.getElementById("formToSend").addEventListener("submit",async(e)=>{
        e.preventDefault();
        const formData=new FormData();
        formData.append("rating",document.getElementById("rating").value);
        formData.append("comment",document.getElementById("commentText").value);
        formData.append("idRes",document.getElementById("resId").value);
        formData.append("user_type",document.getElementById("typeUser").value);
        const response=await fetch("http://localhost/Bricolini/Views/Partenaires/commentHandler.php",{
            method:"POST",
            body:formData
        })
        await response.text().then((data)=>{
            document.getElementById("err").innerHTML=data;
        })
    })
</script>
<?php
require __DIR__ . "/../Components/Footer.php";
?>
</body>
</html>
<style>
.reservationCard {
    position: relative;
}
.comment{
    position: absolute;
    right: -25px;
    bottom: -25px;
}
.comment button{
    background-color: var(--orange);
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
}
.err{
    color:red;
    text-align:center;
    font-family:var(--fontSmall);
    font-size:18px;
}
</style>



