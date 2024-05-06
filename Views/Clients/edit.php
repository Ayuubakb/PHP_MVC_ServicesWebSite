
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Edit</title>
</head>
<body>
    <?php
        require("Views/Components/Nav.php");
    ?>
    <section class="sec">
        <form method="POST" action="http://localhost/Bricolini/Views/Clients/editHandler.php" id="editForm" class="modifier" enctype="multipart/form-data">
            <h1>Modifier Votre Profile</h1>
            <p id="err"></p>
            <?php 
                if(isset($_GET['msg'])){
                    echo "<h1>".$_GET['msg']."</h1>";
                }
            ?>
            <div class="imageHolder">
                <img id="imgProfile" src="<?php echo is_null($profile['image'])?"http://localhost/Bricolini/Views/public/images/icon-admin.png":"http://localhost/Bricolini/Views/public/images/".$profile['image'].""?>"/>
            </div>
            <div class="fieldsContainer">
                <div class="imgLabel">
                    <label>
                        <i class="fa-solid fa-upload fa-lg"></i>
                        <input type="file" accept="image/*" name="pic" value=<?=$profile['image']?> />
                    </label>
                </div>
                <div>
                    <label>Prenom :</label>
                    <input type="text" name="firstName" value="<?=$profile['FirstName']?>"/>
                </div>
                <div>
                    <label>Nom :</label>
                    <input type="text" name="lastName" value="<?=$profile['LastName']?>"/>
                </div>
                <div>
                    <label>Address :</label>
                    <input type="text" name="address"  value="<?=$profile['Address']?>"/>
                </div>
                <div>
                    <label>Telephone :</label>
                    <input type="number" name="telephone"  value="<?=$profile['Telephone']?>"/>
                </div>
            </div>
            <button name="subButton" type="submit">Modifier</button>
        </form>
    </section>
    <?php
        require("Views/Components/Footer.php")
    ?>
</body>
<script>
    document.getElementById("editForm").addEventListener("submit",async function(e){
        e.preventDefault();
        const response=await fetch("http://localhost/Bricolini/Views/Clients/editHandler.php",{
            method:"POST",
            body:new FormData(this)
        })
        await response.json().then((data)=>{
            const show= [
                { opacity:'0' },
                {  opacity:'1' },
                {  opacity:'0'}
            ];

            const showTiming = {
                duration: 3000,
                iterations: 1,
            };
            document.getElementById('err').innerHTML=data.msg
            document.getElementById('err').animate(show, showTiming);
            if(data.msg==="Données Modifiés" && data.img!=null){
                document.getElementById("imgProfile").src="http://localhost/Bricolini/Views/public/images/"+data.img
            }
        })
    })
</script>
</html>
<style>
    #err{
        padding: 10px;
        background-color:var(--green);
        font-family:var(--fontSmall);
        width:50%;
        margin-left:25%;
        border-radius:15px;
        color:white;
        margin-bottom:15px;
        opacity: 0;
        text-align:center;
    }
</style>