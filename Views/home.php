<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/style/Style.css">
    <title>Home</title>
</head>
<body class="home-page">

    <?php include 'Components/Nav.php'; ?>

    <section class="introduction py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="intro-text">
                        <h2 class="text-orange">Bricoliini !!</h2>
                        <p class="lead">Bricolini est votre application #1 de services à domicile au Maroc !
                            Nous offrons une variété de services incluant le nettoyage général, le jardinage, 
                            l'entretien de la pelouse, et bien plus encore. Profitez d'une vie quotidienne sans tracas
                            avec les services à domicile garantis de Bricolini. 
                            Vous n'êtes pas satisfait ? Nous le referons !</p>
                        <a href="#" class="btn btn-primary">Explorez Nos Services</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="logo-container text-center">
                        <img src="Views/public/images/logo.png" alt="Site Logo" class="img-fluid logo">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="services-section">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-6 main-service">
                <h2>Menage</h2>
                <img src="path_to_menage_image"  class="service-image">
                <p></p>
            </div>
           
            <div class="col-md-6 sub-services">
                <div class="slider-container">
                   
                    <div class="slide">
                        <img src="Views\public\images\menage_maison.png" >
                        <h3>Menage maison</h3>
                    </div>
                   
                    <div class="slide">
                        <img src="Views\public\images\nettoyage_g.webp" >
                        <h3>nettoyage general </h3>
                    </div>

                    <div class="slide">
                        <img src="Views\public\images\nettoyage_canap.webp" >
                        <h3>nettoyage canape </h3>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-6 main-service">
                <h2>Jardinage</h2>
                <img src="path_to_jardinage_image"  class="service-image">
                <p></p>
            </div>
            
            <div class="col-md-6 sub-services">
                <div class="slider-container">
                   
                    <div class="slide">
                        <img src="Views\public\images\plantationjardin.webp" >
                        <h3>plantation jardin </h3>
                    </div>
                    
                    <div class="slide">
                        <img src="Views\public\images\traitementjardin.webp" >
                        <h3>traitement jardin </h3>
                    </div>

                    <div class="slide">
                        <img src="Views\public\images\entretienGAZON.webp" >
                        <h3>entretien gazon  </h3>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>




    <?php require("Components/Footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
