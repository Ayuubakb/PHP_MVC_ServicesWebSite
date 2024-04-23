<DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require "navbar.php"; ?>

<center>
    <h1>Interventions</h1>
</center>
<!--a table to show intervention and detail  Date_reserv Statuts partenaire :LastName+FirstName-->
<table class="table">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Statuts</th>
        <th scope="col">Partenaire</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($interventions as $intervention) {
        echo "<tr>";
        echo "<td>" . $intervention['Date_reserv'] . "</td>";
        echo "<td>" . $intervention['Statuts'] . "</td>";
        echo "<td>" . $Partenaire['LastName'] . " " . $Partenaire['FirstName'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>


