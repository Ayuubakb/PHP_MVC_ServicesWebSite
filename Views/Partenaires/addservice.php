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
    <form action="http://localhost/Bricolini/Partenaires/handleAddService" method="post" enctype="multipart/form-data">
        <label for="serviceName">Service Name:</label><br>
        <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['user_id'] ?>">
        <input type="text" id="serviceName" name="serviceName"><br>
        <label for="serviceDescription">Service Description:</label><br>
        <textarea id="serviceDescription" name="serviceDescription"></textarea><br>
        <label for="servicePrice">Service Price:</label><br>
        <input type="number" id="servicePrice" name="servicePrice" min="0" step="0.01"><br>
        <label for="serviceImage">Service Image:</label><br>
        <input type="file" id="serviceImage" name="serviceImage"><br>
        <label for="serviceCategory">Service Category:</label><br>
<!--        jardennage or menage -->
        <select id="serviceCategory" name="serviceCategory">
            <option value="jardennage">Jardinage</option>
            <option value="menage">Nettoyage</option>
        </select><br>
        <label for="servicesousCategory">Service Sous Category:</label><br>
<!--        depend if he selected jardinage or menage-->
        <select id="servicesousCategory" name="servicesousCategory">
            <option value="Nettoyage de canapés">Nettoyage de canapés</option>
            <option value="Nettoyage des surfaces">Nettoyage des surfaces</option>
            <option value="Nettoyage général">Nettoyage général</option>
            <option value="Entretien de Gazon et Pelouse">Entretien de Gazon et Pelouse</option>
            <option value="Traitement de jardin">Traitement de jardin</option>
            <option value="Plantation pour jardin">Plantation pour jardin</option>
        </select><br>
        <button onclick="addService()" type="submit">Add Service</button>
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