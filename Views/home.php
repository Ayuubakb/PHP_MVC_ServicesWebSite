<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style/Style.css">
    <title>Home</title>
</head>
<body class="home-page">

    <?php include 'Components/Nav.php'; ?>

    <section class="introduction">
<div class="container">
    <div class="intro-content">
        <div class="intro-text">
            <h2> Bricoliini !!</h2>
            <p>Bricolini est votre application  #1 de services à domicile marocains !
                Nous offrons une variété de services incluant le nettoyage général, le jardinage, 
                l'entretien de la pelouse, et plus encore. Profitez d'une vie quotidienne sans tracas
                avec les services à domicile garantis de Bricolini. 
                Vous n'êtes pas satisfait ? Nous le referons !</p>
        </div>
        <div class="logo-container">
        <img src="Views/public/images/logo.png" alt="Site Logo" class="logo">
        </div>
    </div>
</div>
    </section>

    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="slider">
                <div class="slide">
                    <h3>Jardinage</h3>
                    <ul>
                        <li>Entretien de Gazon et Pelouse</li>
                        <li>Traitement de Jardin</li>
                        <li>Plantation pour Jardin</li>
                    </ul>
                </div>
                <div class="slide">
                    <h3>Menage</h3>
                    <ul>
                        <li>Nettoyage Général</li>
                        <li>Nettoyage de Canapé</li>
                        <li>Nettoyage de Surface</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php require("Components/Footer.php"); ?>

</body>
</html>


