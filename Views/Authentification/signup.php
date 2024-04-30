<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../public/style/Style.css">
</head>
<body class="signup-body">
    <h1>Inscrivez Vous a Bricoliini !</h1>
    <form action="/user/signup" method="post" enctype="multipart/form-data">
        <input type="text" name="LastName" placeholder="Nom" required>
        <input type="text" name="FirstName" placeholder="Prénom" required>
        <input type="text" name="Email" placeholder="Email" required>
        <input type="text" name="Telephone" placeholder="Téléphone" required>
        
        <input type="text" name="Address" placeholder="Adresse">
        
        <!-- Case à cocher pour spécifier si l'utilisateur est un partenaire -->
        <label>
            <input type="checkbox" name="isPartenaire" id="isPartenaireCheck"> Je suis un partenaire
        </label>
        
        <!-- Champs spécifiques aux partenaires, cachés par défaut -->
        <div id="champsPartenaire" style="display: none;">
            <input type="text" name="Metier" placeholder="Métier">
            <input type="text" name="Ville" placeholder="Ville">
            <input type="text" name="Creneaux" placeholder="Créneaux">
            <input type="number" name="YearExperience" placeholder="Années d'expérience">
        </div>
        
        <input type="submit" value="S'inscrire">
    </form>

    <script>
        document.getElementById('isPartenaireCheck').addEventListener('change', function() {
            var display = this.checked ? 'block' : 'none';
            document.getElementById('champsPartenaire').style.display = display;
        });
    </script>
</body>
</html>