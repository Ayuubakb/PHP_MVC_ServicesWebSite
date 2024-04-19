<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom"> <!-- Replace with navbar-custom -->
  <a class="navbar-brand" href="#">
    <img src="../public/images/logo.png" alt="Logo" style="width:120px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Partenaire/Interventions<?php=$Partenaire['id']?>">Mes Interventions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Partenaire/Commentaires<?php=$Partenaire['id']?>">Commentaires</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Partenaire/Historique<?php=$Partenaire['id']?>">Historique</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../Authentification/logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
</body>
</html>
<style>
    .navbar-custom {
    background-color: #FFB534;
}

.navbar-custom .navbar-brand,
.navbar-custom .nav-link {
    color: #FFFFFF;
}

.navbar-custom .nav-link:hover {
    color: #000000;
}
</style>