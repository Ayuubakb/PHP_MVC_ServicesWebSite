<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <?php 
        session_start();
        require 'Components/Nav.php'; 
    ?>
    <section class="sec home">
        <div class="premier">
            <div class="imageHolder">
                <div>
                    <img src="Views/public/images/logo.png"/>
                </div>
            </div>
            <div class="description">
                <h1>Bricolini</h1>
                <p>"Bienvenue chez Bricolini, votre destination de confiance pour tous vos besoins en entretien domestique. Nous vous connectons avec des partenaires fiables et expérimentés qui vous offriront des services de ménage et de jardinage exceptionnels. Chez Bricolini, nous comprenons l'importance d'un foyer propre et bien entretenu, c'est pourquoi nous nous engageons à fournir des services de qualité supérieure à des prix abordables. Découvrez dès maintenant comment nous pouvons simplifier votre vie et rendre votre maison encore plus accueillante avec Bricolini."</p>
                <a href="http://localhost/Bricolini/Services"><button>Services</button></a>
            </div>
        </div>
        <div><p class="slogan">Entretien parfait, confiance assurée : Bricolini, votre allié pour un foyer impeccable</p></div>
        <div class="seconde one">
            <div class="imageHolder">
                <div>
                    <img src="Views/public/servicePic/jardinageDefault.jpg"/>
                </div>
            </div>
            <div class="serContainer">
                <div class="servi">
                    <div class="imageContainer">
                       <div> 
                            <img src="Views/public/images/entretienGAZON.webp"/>
                        </div>
                    </div>
                    <div class="title">
                        <h1>Etretien de Gazon Et De Pelouse</h1>
                    </div>
                </div>
                <div class="servi">
                    <div class="imageContainer">
                        <div>
                        <img src="Views/public/images/traitementjardin.webp"/></div>
                    </div>
                    <div class="title">
                        <h1>Traitement De Jardin</h1>
                    </div>
                </div>
                <div class="servi">
                    <div class="imageContainer">
                        <div><img src="Views/public/images/plantationjardin.webp"/></div>
                    </div>
                    <div class="title">
                        <h1>Plantation du Jardin</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="seconde two">
            <div class="serContainer">
                <div class="servi">
                    <div class="imageContainer">
                       <div> 
                            <img src="Views/public/images/nettoyage_canap.webp"/>
                        </div>
                    </div>
                    <div class="title">
                        <h1>Nettoyage de canapés</h1>
                    </div>
                </div>
                <div class="servi">
                    <div class="imageContainer">
                        <div>
                        <img src="Views/public/images/nettoyage_surfaces.webp"/></div>
                    </div>
                    <div class="title">
                        <h1>Nettoyage des surfaces</h1>
                    </div>
                </div>
                <div class="servi">
                    <div class="imageContainer">
                        <div><img src="Views/public/images/nettoyage_g.webp"/></div>
                    </div>
                    <div class="title">
                        <h1>Nettoyage général</h1>
                    </div>
                </div>
            </div>
            <div class="imageHolder">
                <div>
                    <img src="Views/public/servicePic/menageDefault.jpg"/>
                </div>
            </div>
        </div>
        <div><p class="slogan" style="background-color:#FFB534;color:black">"La simplicité est la sophistication suprême." - Léonard de Vinci</p></div>
        <div class="steps">
            <div class="step">
                <div>
                   <div  class="num"><p>1</p></div>
                </div>
                <div class="des">
                    <h1>Sélectionnez le service adapté à vos besoins. <i class="fa-solid fa-bell-concierge fa-xl"></i></h1>
                </div>
            </div>
            <div  class="step">
                <div  class="des">
                    <h1>Choisissez une date et une plage horaire qui vous conviennent. <i class="fa-solid fa-clock fa-xl"></i></h1>
                </div>
                <div>
                   <div  class="num" style="background-color:#FFB534;"><p>2</p></div>
                </div>
            </div>
            <div  class="step">
                <div>
                   <div  class="num" style="background-color:black;"><p>3</p></div>
                </div>
                <div  class="des">
                    <h1>Attendez la confirmation du partenaire. <i class="fa-solid fa-check fa-xl"></i></h1>
                </div>
            </div>
        </div>
    </section>
    <?php require("Components/Footer.php"); ?>
</body>
</html>
