<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/addservice.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>

    <title>Ajouter un service</title>
</head>
<body>
<?php
require("Views/Components/Nav.php");
?>
<div class="container">
    <form id="editForm" class="fromAddService" action="http://localhost/Bricolini/Views/Partenaires/serviceeditHandler.php" method="post" enctype="multipart/form-data">
        <h1 class="headTitle">Ajouter un service</h1>
        <p id="err"></p>
        <div>
            <label for="serviceName">Nom du service: </label>
            <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['user_id'] ?>">
            <input type="text" id="serviceName" name="serviceName" required>
        </div>
        <div class="price">
            <div>
                <label for="servicePrice">Prix du service:</label>
                <input type="number" id="servicePrice" name="servicePrice" min="0" step="0.01" required>
            </div>
            <div>
                <label for="serviceImage">Image du service:</label>
                <input type="file" id="serviceImage" name="serviceImage" style="display: none;">
                <label for="serviceImage" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> Sélectionner une image
                </label>
            </div> 
        </div> 
        <div class="servicess">
            <div>
                <label for="serviceCategory">Service Category:</label>
        <!--        jardennage or menage -->
                <select id="serviceCategory" name="serviceCategory" required>
                    <?php
                        if(!strcmp($metier[0],"Menage")){
                            echo "
                            <option value='Menage'>Nettoyage</option>";
                        }else{
                            echo "
                            <option value='Jardinage' selected>Jardinage</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="servicesousCategory">Service Sous Category:</label>
        <!--        depend if he selected jardinage or menage-->
                <select id="servicesousCategory" name="servicesousCategory" required>
                    <option value="Nettoyage de canapés">Nettoyage de canapés</option>
                    <option value="Nettoyage des surfaces">Nettoyage des surfaces</option>
                    <option value="Nettoyage général">Nettoyage général</option>
                    <option value="Entretien de Gazon et Pelouse">Entretien de Gazon et Pelouse</option>
                    <option value="Traitement de jardin">Traitement de jardin</option>
                    <option value="Plantation pour jardin">Plantation pour jardin</option>
                </select>
            </div>
        </div>
        <div>
            <label for="serviceDescription">Service Description:</label>
            <textarea id="serviceDescription" name="serviceDescription"required></textarea>
        </div>
        <div class="errs">
            <div class="btn">
                <button onclick="addService()" type="submit" id="submit">Ajouter un service</button>
            </div>
            <div class="btn">
                <button id="Cancel" type="button" onclick="window.location
                        .href='http://localhost/Bricolini/Partenaires/index/<?php echo $_SESSION['user_id'] ?>';
                        ">Annuler</button>
            </div>
        </div>
    </form>
</div>
</body>
<?php
require 'Views/Components/Footer.php';
?>
</html>
<script>
    // Define the sous categories for each category
var jardennageSousCategories = ["Entretien de Gazon et Pelouse", "Traitement de jardin", "Plantation pour jardin"];
var menageSousCategories = ["Nettoyage de canapés", "Nettoyage des surfaces", "Nettoyage général"];

// Get the category and sous category select boxes
var categorySelect = document.getElementById("serviceCategory");
var sousCategorySelect = document.getElementById("servicesousCategory");

// Add an event listener to the category select box
categorySelect.addEventListener("change", function() {
    // Clear the sous category select box
    sousCategorySelect.innerHTML = "";

    // Get the selected category
    var selectedCategory = categorySelect.value;

    // Get the corresponding sous categories
    var sousCategories;
    if (selectedCategory === "Jardinage") {
        sousCategories = jardennageSousCategories;
    } else if (selectedCategory === "Menage") {
        sousCategories = menageSousCategories;
    }

    // Populate the sous category select box with the sous categories
    for (var i = 0; i < sousCategories.length; i++) {
        var option = document.createElement("option");
        option.value = sousCategories[i].toLowerCase();
        option.text = sousCategories[i];
        sousCategorySelect.appendChild(option);
    }
});
// Trigger the change event to populate the sous category select box on page load
categorySelect.dispatchEvent(new Event("change"));
document.getElementById("editForm").addEventListener("submit",async function(e){
    e.preventDefault();
    const response=await fetch("http://localhost/Bricolini/Views/Partenaires/serviceeditHandler.php",{
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
    })
})
</script>
<style>
    .headTitle{
        margin-top:5px;
        color:white
    }
    /*    style for the form*/
    .container {
        padding: 16px;
        background-color: white;
        margin-top: 20px;
        margin-left: 10%;
        margin-right: 10%;
        border-radius: 10px;
    }
    /*    style for the form labels*/
    label{
        font-size: 24px;
        font-family: var(--fontSmall);
        color:white
    }
    /*    style for the form inputs*/
    input[type="text"], input[type="number"], textarea, select{
        width: 100%;
        padding: 7px;
        border-radius:15px;
        border:none;
        font-size:20px;
        color:rgb(89,89,89);
        outline:none
    }
    .custom-file-upload {
        margin-top:7px;
        padding:10px 18px;
        cursor: pointer;
        background-color: var(--lightGreen);
        color: white;
        border-radius: 4px;
        font-size: 16px;
        text-align:center;
        border-radius:15px;
        color:var(--orange);
        font-family:var(--fontSmall);
        font-weight:bold
    }
    .fromAddService{
        margin-top:0
    }
    .fromAddService div:not(.errs,.price,.servicess){
        display:flex;
        flex-direction:column;
        width:90%;
        margin-left:5%
    }
    .fromAddService .servicess, .fromAddService .price{
        display :flex;
        flex-direction:row;
        align-items:center;
        width :95%;
    }
    .errs{
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:space-around;
        width:80%;
        margin-top:35px
    }
    .errs button{
        background-color:var(--green);
        border:none;
        border-radius:15px;
        padding:10px 18px;
        font-family:var(--fontBig);
        font-size:22px;
        color:white
    }
    #Cancel{
        background-color:red;
    }
    #err{
        padding: 10px;
        background-color:var(--green);
        font-family:var(--fontSmall);
        width:50%;
        margin-left:0%;
        border-radius:15px;
        color:white;
        margin-bottom:15px;
        opacity: 0;
        text-align:center;
    }
</style>