<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
</head>
<body>
    <h1>Add Service</h1>
    <form action="http://localhost/Bricolini/Partenaires/addservice" method="post">
        <label for="serviceName">Service Name:</label><br>
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
            <option value="jardennage">Jardennage</option>
            <option value="menage">Menage</option>
        </select><br>
        <label for="servicesousCategory">Service Sous Category:</label><br>
<!--        depend if he selected jardinage or menage-->
        <select id="servicesousCategory" name="servicesousCategory">
            <option value="tonte">Tonte</option>
            <option value="taille">Taille</option>
            <option value="arrosage">Arrosage</option>
            <option value="nettoyage">Nettoyage</option>
            <option value="repassage">Repassage</option>
            <option value="vaisselle">Vaisselle</option>
        </select><br>


        <input type="submit" value="Add Service">
    </form>
</body>
</html>
<script>
    // Define the sous categories for each category
var jardennageSousCategories = ["Tonte", "Taille", "Arrosage"];
var menageSousCategories = ["Nettoyage", "Repassage", "Vaisselle"];

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