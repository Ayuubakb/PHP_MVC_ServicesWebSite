<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom"> <!-- Replace with navbar-custom -->
  <a class="navbar-brand" href="#">
    <img src="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/Bricolini/Views/public/images/logo.png"; ?>" alt="Logo" style="width:120px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/Bricolini/home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="interventions">Mes Interventions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/Bricolini/Partenaire/Commentaires<?php $Partenaire['id']?>">Commentaires</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/Bricolini/Partenaire/Historique<?php $Partenaire['id']?>">Historique</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/Bricolini/Authentification/logout.php">Logout</a>
      </li>
<li class="nav-item">
        <a class="nav-link" href="http://localhost/Bricolini/Partenaires">Profile</a>
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