<DOCTYPE HTML >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Modifier le Profile </title>
</head>
<body>
<?php require "navbar.php";
?>
<center>
    <h1>Modifier le Profile </h1>
</center>

<form>
<!-- LastName , FirstName, Metier, Ville ,Creneaux, YearExperience ,Email,Telephone-->
    <div class="form-group">
        <label for="LastName">Nom</label>
        <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $Partenaire['LastName']; ?>">
    </div>
    <div class="form-group
    ">
        <label for="FirstName">Prenom</label>
        <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $Partenaire['FirstName']; ?>">
    </div>
    <div class="form-group">
        <label for="Metier">Metier</label>
        <input type="text" class="form-control" id="Metier" name="Metier" value="<?php echo $Partenaire['Metier']; ?>">
    </div>
    <div class="form-group">
        <label for="Ville">Ville</label>
        <input type="text" class="form-control" id="Ville" name="Ville" value="<?php echo $Partenaire['Ville']; ?>">
    </div>
    <div class="form-group">
        <label for="Creneaux">Creneaux</label>
        <input type="text" class="form-control" id="Creneaux" name="Creneaux" value="<?php echo $Partenaire['Creneaux']; ?>">
    </div>
    <div class="form-group">
        <label for="YearExperience">YearExperience</label>
        <input type="text" class="form-control" id="YearExperience" name="YearExperience" value="<?php echo $Partenaire['YearExperience']; ?>">
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $Partenaire['Email']; ?>">
    </div>
    <div class="form-group">
        <label for="Telephone">Telephone</label>
        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?php echo $Partenaire['Telephone']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
<!--    cancel button -->
    <a href="profil" class="btn btn-danger">Cancel</a>
</form>
</body>

