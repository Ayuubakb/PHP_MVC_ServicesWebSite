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
    <form method="POST" action="http://localhost/Bricolini/Partenaires/updateInfos" class="modifier" enctype="multipart/form-data">
        <h1>Modifier Votre Profile</h1>
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
                <label>Metier :</label>
                <input type="text" name="Metier" value="<?=$profile['Metier']?>"/>
            </div>
            <div>
                <label>Ville :</label>
                <input type="text" name="Ville" value="<?=$profile['Ville']?>"/>
            </div>
            <div>
                <label>Year Experience :</label>
                <input type="number" name="YearExperience" value="<?=$profile['YearExperience']?>"/>
            </div>
            <div>
                <label>Email :</label>
                <input type="email" name="Email" value="<?=$profile['Email']?>"/>
            </div>
            <div>
                <label>Telephone :</label>
                <input type="tel" name="Telephone" value="<?=$profile['Telephone']?>"/>
            </div>
<!--            Update creneaux-->
            <div>
                <label>Creneaux :</label>
                <div class="creneaux">
                  <?php
$Creaneaux = explode("/",$profile['Creneaux']);
foreach($Creaneaux as $creneaux){
    $parts = explode(":", $creneaux);
    if(count($parts) == 2) {
        $day = $parts[0];
        $time_parts = explode("-", $parts[1]);
        if(count($time_parts) == 2) {
            $from = strlen($time_parts[0]) <= 2 ? $time_parts[0].":00" : $time_parts[0];
            $to = strlen($time_parts[1]) <= 2 ? $time_parts[1].":00" : $time_parts[1];
            $from = date("H:i", strtotime($from));
            $to = date("H:i", strtotime($to));
            echo "<div class='time-slot'>
                    <div>
                        <label>Day:</label>
                        <input type='text' name='day[]' value='".$day."'/>
                    </div>
                    <div>
                        <label>From:</label>
                        <input type='time' name='from[]' value='".$from."'/>
                    </div>
                    <div>
                        <label>To:</label>
                        <input type='time' name='to[]' value='".$to."'/>
                    </div>
                  </div>";
        }
    }
}
?>
                </div>
            </div>

        </div>
        <button name="subButton" type="submit">Modifier</button>
        <button name="Cancel" id="Cancel" type="button" onclick="window.location.href='http://localhost/Bricolini/Partenaires/index/<?php echo $_SESSION['user_id']?>'">Annuler</button>
    </form>
</section>
<?php
require("Views/Components/Footer.php")
?>
</body>
</html>
<style>
    .time-slot {
    display: flex;
    justify-content: space-between;
}
    #Cancel {
    background-color: red;
    }

</style>