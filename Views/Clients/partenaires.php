<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Client.css">
    <script src="http://localhost/Bricolini/Views/public/js/Functions.js"></script>
    <title>Partenaire</title>
</head>
<body>
    <?php require("Views/Components/Nav.php")  ?>
    <section class="sec partenaire">
        <div class="leftBar">
            <form method="POST" action="http://localhost/Bricolini/Clients/partenaires">
                <div>
                    <input type="text" name="nom" placeholder="nom" value=""/>
                </div>
                <div>
                    <input type="text" name="ville" placeholder="ville" value=""/>
                </div>
                <div>
                    <select name="rating">
                        <option value=6 selected>Note</option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select>
                </div>
                <div>
                    <select name="metier">
                        <option value="" selected>Menage & Jardinage</option>
                        <option value=menage>Menage</option>
                        <option value=jardinage>Jardinage</option>
                    </select>
                </div>
                <button type="submit" name="subBtn">Chercher</button>
            </form>
        </div>
        <div class="main">
            <div class="cardsHolder">
                <?php
                foreach($partenaires as $partenaire ){
                    echo "
                    
                    <div class='partenaireCard'>
                        <a href='http://localhost/Bricolini/Partenaires/index/".$partenaire['id']."'>
                        <div class='header'>
                            <div class='imageContainer'>
                                <img src='../Views/public/images/".$partenaire['image']."'/>
                            </div>
                            <div class='note'>
                            ";
                                if($partenaire['Note']!=null)
                                    echo "<p>".number_format($partenaire['Note'],1)."/5</p>";
                                else
                                    echo "<p>-/5</p>";
                            echo"
                            </div>
                        </div>
                        <div class='infoContainer'>
                            <div>
                                <p><span>Prenom : </span>".$partenaire['FirstName']."</p>
                                <p><span>Nom : </span>".$partenaire['LastName']."</p>
                            </div>
                            <div>
                                <p><span>Metier : </span>".$partenaire['Metier']."</p>
                                <p><span>Ville : </span>".$partenaire['Ville']."</p>
                            </div>
                        </div>
                        </a>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php require("Views/Components/Footer.php")  ?>
</body>
</html>