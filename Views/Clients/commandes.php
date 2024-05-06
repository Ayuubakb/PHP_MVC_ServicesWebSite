<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="http://localhost/Bricolini/Views/public/js/Clients.js"></script>
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Commandes Client</title>
</head>
<body>
    <?php
        require("Views/Components/Nav.php");
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
                <input type="hidden" id="resId"/>
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
                    <button onClick="getSearchparm()">OK</button>
                </div>
            </div>
            <div class="commandesAll">
            <?php
                if(count($profile->commandes)!=0){
                    foreach($profile->commandes as $commande){
                        $status="";
                        switch ($commande->Statuts){
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
                                <img src='http://localhost/Bricolini/Views/public/images/".$commande->image."'>
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
                                </div>";
                                if($commande->Statuts ==3 ){
                                    echo"
                                <div class='comment'>
                                    <button onclick=\"showCommentForm({$commande->id})\"><i class='fas fa-comment fa-lg'></i></button>
                                </div>  " ;
                                }
                                echo "
                            </div>
                        </div>";
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