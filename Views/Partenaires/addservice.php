<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/addservice.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>

    <title>Add Service</title>
</head>
<body>
<?php
require("Views/Components/Nav.php");
?>
    <h1>Add Service</h1>
<div class="container">
    <form action="http://localhost/Bricolini/Views/Partenaires/serviceeditHandler.php" method="post" enctype="multipart/form-data">
        <label for="serviceName">Service Name:</label><br>
        <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['user_id'] ?>">
        <input type="text" id="serviceName" name="serviceName" required><br>
        <label for="serviceDescription">Service Description:</label><br>
        <textarea id="serviceDescription" name="serviceDescription"required></textarea><br>
        <label for="servicePrice">Service Price:</label><br>
        <input type="number" id="servicePrice" name="servicePrice" min="0" step="0.01" required><br>
        <label for="serviceImage">Service Image:</label><br>
        <input type="file" id="serviceImage" name="serviceImage" style="display: none;">
        <label for="serviceImage" class="custom-file-upload">
            <i class="fa fa-cloud-upload"></i> Upload Image
        </label>
        <label for="serviceCategory">Service Category:</label><br>
<!--        jardennage or menage -->
        <select id="serviceCategory" name="serviceCategory" required>
            <option value="jardennage">Jardinage</option>
            <option value="menage">Nettoyage</option>
        </select><br>
        <label for="servicesousCategory">Service Sous Category:</label><br>
<!--        depend if he selected jardinage or menage-->
        <select id="servicesousCategory" name="servicesousCategory" required>
            <option value="Nettoyage de canapés">Nettoyage de canapés</option>
            <option value="Nettoyage des surfaces">Nettoyage des surfaces</option>
            <option value="Nettoyage général">Nettoyage général</option>
            <option value="Entretien de Gazon et Pelouse">Entretien de Gazon et Pelouse</option>
            <option value="Traitement de jardin">Traitement de jardin</option>
            <option value="Plantation pour jardin">Plantation pour jardin</option>
        </select><br>
        <button onclick="addService()" type="submit" id="submit">Add Service</button>
        <button id="Cancel" type="button" onclick="window.location.href='http://localhost/Bricolini/Partenaires/index/<?php echo $_SESSION['user_id'] ?>';">Cancel</button>
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
    if (selectedCategory === "jardennage") {
        sousCategories = jardennageSousCategories;
    } else if (selectedCategory === "menage") {
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
</script>
<style>
/*    style for the file input and the submit button*/
    input[type="file"]{
        margin-top: 10px;
    }
    #submit{
        margin-top: 10px;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 80px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    #submit:hover {
        opacity: 0.8;
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
        font-size: 30px;
        font-family: var(--fontBig);

    }
    /*    style for the form inputs*/
    input[type="text"], input[type="number"], textarea, select{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }
    /*    style for the form inputs when focused*/
    input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus{
        background-color: #f3f3f3;
    }
    /*    style for the form button*/
    button{
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    /*    style for the form button when hovered*/
    button:hover {
        opacity: 0.8;
    }
    /*    style for the form button when disabled*/
    button:disabled{
        background-color: #cccccc;
    }
    /*    style for the form button when disabled and hovered*/
    button:disabled:hover{
        opacity: 1;
    }
    /*    style for the form button when disabled and focused*/
    button:disabled:focus{
        background-color: #cccccc;
    }
    /*    style for the form button when disabled and active*/
    button:disabled:active{
        background-color: #cccccc
    }
    .custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border-radius: 4px;
    font-size: 16px;
}
    #Cancel{
        background-color: #f44336;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    #Cancel:hover {
        opacity: 0.8;
    }
</style>