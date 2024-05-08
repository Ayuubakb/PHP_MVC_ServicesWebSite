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
<section class="sec" style="padding-bottom:15px">
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
            <section>
                <div class="creneauss">
                <?php
                    $Creaneaux = explode("/",$profile['Creneaux']);
                    $array=array();
                    foreach($Creaneaux as $creneaux){
                        $objct=new stdClass();
                        $parts = explode(":", $creneaux);
                        if(count($parts) == 2) {
                            $day = $parts[0];
                            $time_parts = explode("-", $parts[1]);
                            if(count($time_parts) == 2) {
                                $from = strlen($time_parts[0]) <= 2 ? $time_parts[0].":00" : $time_parts[0];
                                $to = strlen($time_parts[1]) <= 2 ? $time_parts[1].":00" : $time_parts[1];
                                $from = date("H:i", strtotime($from));
                                $to = date("H:i", strtotime($to));
                                $objct->from=$from;
                                $objct->to=$to;
                                $array[$day]=$objct;
                            }
                        }

                    }
                   ?>
                    <div class='timeslot'>
                        <div>
                            <label>Lundi :
                            <input id="lundiDay" type='checkbox' name='day[]' value='Lundi' <?= isset($array['Lundi'])? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Lundi'])? "style='display:none;'":null   ?> class="heureContainer" id="lundiHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Lundi']->from)?$array['Lundi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]'  value='<?=isset($array['Lundi']->to)?$array['Lundi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Mardi :
                            <input id="mardiDay" type='checkbox' name='day[]' value='Mardi' <?= isset($array['Mardi'])? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Mardi'])? "style='display:none;'" :null   ?> class="heureContainer" id="mardiHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Mardi']->from)?$array['Mardi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Mardi']->to)?$array['Mardi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Mercredi :
                            <input id="mercrediDay" type='checkbox' name='day[]' value='Mercredi' <?= isset($array['Mercredi'])!=null? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Mercredi'])? "style='display:none;'" :null   ?> class="heureContainer" id="mercrediHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Mercredi']->from)?$array['Mercredi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Mercredi']->to)?$array['Mercredi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Jeudi :
                            <input id="jeudiDay" type='checkbox' name='day[]' value='Jeudi' <?= isset($array['Jeudi'])? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Jeudi'])? "style='display:none;'" :null   ?> class="heureContainer" id="jeudiHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Jeudi']->from)?$array['Jeudi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Jeudi']->to)?$array['Jeudi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Vendredi :
                            <input id="vendrediDay" type='checkbox' name='day[]' value='Vendredi' <?= isset($array['Vendredi'])!=null? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Vendredi'])? "style='display:none;'" :null   ?> class="heureContainer" id="vendrediHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Vendredi']->from)?$array['Vendredi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Vendredi']->to)?$array['Vendredi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Samedi :
                            <input id="samediDay" type='checkbox' name='day[]' value='Samedi' <?= isset($array['Samedi'])? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Samedi'])? "style='display:none;'" :null   ?> class="heureContainer" id="samediHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Samedi']->from)?$array['Samedi']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Samedi']->to)?$array['Samedi']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                    <div class='timeslot'>
                        <div>
                            <label>Dimanche :
                            <input id="dimancheDay" type='checkbox' name='day[]' value='Dimanche' <?= isset($array['Dimanche'])? 'checked' :null   ?>/>
                            </label>
                        </div>
                        <div <?= !isset($array['Dimanche'])? "style='display:none;'" :null ?> class="heureContainer" id="dimancheHeure">
                            <div>
                                <label>From:</label>
                                <input type='time' name='from[]' value='<?=isset($array['Dimanche']->from)?$array['Dimanche']->from:null ?>'/>
                            </div>
                            <div>
                                <label>To:</label>
                                <input type='time' name='to[]' value='<?=isset($array['Dimanche']->to)?$array['Dimanche']->to:null ?>'/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        <div class="btns">
            <button name="subButton" type="submit">Modifier</button>
            <button name="Cancel" id="Cancel" type="button" onclick="window.location.href='http://localhost/Bricolini/Partenaires/index/<?php echo $_SESSION['user_id']?>'">Annuler</button>
        </div>
        </div>
    </form>
</section>
<?php
require("Views/Components/Footer.php")
?>
<script>
    document.getElementById('lundiDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('lundiHeure').style.display = display;
    })
    document.getElementById('mardiDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('mardiHeure').style.display = display;
    })
    document.getElementById('mercrediDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('mercrediHeure').style.display = display;
    })
    document.getElementById('jeudiDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('jeudiHeure').style.display = display;
    })
    document.getElementById('vendrediDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('vendrediHeure').style.display = display;
    })
    document.getElementById('samediDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('samediHeure').style.display = display;
    })
    document.getElementById('dimancheDay').addEventListener("change",function(e){
        var display = this.checked ? 'flex' : 'none';
        document.getElementById('dimancheHeure').style.display = display;
    })
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
    #Cancel {
    background-color: red;
    }
    .fieldsContainer section{
       width:100%;
       padding-top:25px;
       border-radius:15px
    }
    .creneauss{
        display:flex;
        flex-wrap:wrap;
        width:100%;
        flex-direction:row;
    }
    .timeslot{
       background-color: var(--orange);
       border-radius:15px;
       flex:0 0 45%;
       margin-bottom:15px;
       margin-left:2.5%;
       padding-left:25px;
       padding-top:10px;
       min-height:110px;
    }
    .timeslot label{
        color:white
    }
    .heureContainer{
        display:flex;
        margin-top:20px;
        justify-content:space-around
    }
    .btns{
        display:flex;
        flex-direction:row;   
        align-items:center;
        justify-content:space-around;
    }
    .btns button{
        border: none;
        background-color: var(--green);
        color: var(--white);
        font-family: var(--fontBig);
        font-size: 20px;
        padding: 12px 20px;
        margin-top: 20px;
        cursor: pointer;
        border-radius: 15px;
        width: 45%;
    }
</style>