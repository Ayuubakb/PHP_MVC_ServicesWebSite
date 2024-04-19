
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Inscription</h2>
    <form action="process_signup.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="LastName">Nom:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" required>
        </div>
        <div class="form-group">
            <label for="FirstName">Prénom:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" required>
        </div>
        <div class="form-group">
            <label for="Email">Email (Partenaires uniquement):</label>
            <input type="email" class="form-control" id="Email" name="Email">
        </div>
        <div class="form-group">
            <label for="Telephone">Téléphone (Clients uniquement):</label>
            <input type="text" class="form-control" id="Telephone" name="Telephone">
        </div>
        <div class="form-group">
            <label for="image">Image (optionnel) :</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-custom">S'inscrire</button>
    </form>
</div>
</body>
</html>
```
