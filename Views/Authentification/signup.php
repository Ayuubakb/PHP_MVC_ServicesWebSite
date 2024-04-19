<form action="/user/signup" method="post" enctype="multipart/form-data">
    
    <input type="text" name="LastName" placeholder="Nom" required>
    <input type="text" name="FirstName" placeholder="Prénom" required>
    <input type="text" name="Email" placeholder="Email" required>
    <input type="text" name="Telephone" placeholder="Téléphone" required>
    
    <!-- Champs spécifiques aux clients -->
    <input type="text" name="Address" placeholder="Adresse">
    
    <!-- Champs spécifiques aux partenaires -->
    <input type="text" name="Metier" placeholder="Métier">
    <input type="text" name="Ville" placeholder="Ville">
    <input type="text" name="Creneaux" placeholder="Créneaux">
    <input type="number" name="YearExperience" placeholder="Années d'expérience">
    
    
    <!-- Champ pour distinguer client/partenaire -->
    <input type="hidden" name="type" value="client"> <!-- ou value="partenaire" selon le cas -->
    
    <input type="submit" value="S'inscrire">
</form>