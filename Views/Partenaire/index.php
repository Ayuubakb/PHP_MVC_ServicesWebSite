<?php require "C:/xampp/htdocs/bricolini/Views/Components/Nav.php"; ?>
<!-- palette de coleur:
FFB534 : yellow
FBF6EE : white
C1F2B0 : light green
65B741 : green
-->
<!-- using this pallete and bootsrap create a index page for partenaire -->
<!DOCTYPE HTML >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="C:/xampp/htdocs/bricolini/Views/public/style/Style.css">
    <title>Partenaire</title>
</head>
<body>
<h1>Partenaire </h1>
<h3>Welcome: <?php echo $Partenaire['Firstname']+ " " + $Partenaire['Lastname'] ?></h3>
</body>
</html>
