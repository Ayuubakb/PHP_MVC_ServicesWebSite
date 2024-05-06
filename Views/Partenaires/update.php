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
    <form id="editForm" method="POST" action="http://localhost/Bricolini/Views/Partenaires/editHandler.php" class="modifier" enctype="multipart/form-data">
        <h1>Modifier Votre Profile</h1>
        <p id="err"></p>
        <div class="imageHolder">
            <img id="imgProfile" src="<?php echo is_null($profile['image'])?"http://localhost/Bricolini/Views/public/clientPic/icon-admin.png":"http://localhost/Bricolini/Views/public/images/".$profile['image'].""?>"/>
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
<script>
    document.getElementById("editForm").addEventListener("submit",async function(e){
        e.preventDefault();
        const response=await fetch("http://localhost/Bricolini/Views/Partenaires/editHandler.php",{
            method:"POST",
            body:new FormData(this)
        })
        await response.json().then((data)=>{
            console.log(data);
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
</body>
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
    .time-slot {
    display: flex;
    justify-content: space-between;
}
    #Cancel {
    background-color: red;
    }

</style>