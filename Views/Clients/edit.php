
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
        <form method="POST" action="http://localhost/Bricolini/Clients/updateInfos" class="modifier" enctype="multipart/form-data">
            <h1>Modifier Votre Profile</h1>
            <?php 
                if(isset($_GET['msg'])){
                    echo "<h1>".$_GET['msg']."</h1>";
                }
            ?>
            <div class="imageHolder">
                <img src="<?php echo is_null($profile['image'])?"http://localhost/Bricolini/Views/public/clientPic/icon-admin.png":"http://localhost/Bricolini/Views/public/images/".$profile['image'].""?>"/>
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
</html>