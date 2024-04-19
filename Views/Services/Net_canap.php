<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cleaning Service Selection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        body {
            background-color: #FBF6EE; /* Very light yellowish-white */
        }

        .services-section {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
        }

        .service-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            transition: box-shadow 0.2s;
        }

        .service-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .service-image {
            margin-right: 16px;
        }

        .service-image img {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .service-description {
            flex: 1;
        }

        .service-price {
            color: #FFB534;
            font-weight: bold;
            margin-right: 16px;
            font-size: 1.2rem;
        }

        .service-add {
            color: #65B741;
            cursor: pointer;
        }

        /* Adjusting button and plus icon size for better visibility */
        .service-add:before {
            content: '+';
            font-size: 1.5rem;
            padding: 8px;
            background-color: #FBF6EE; /* Very light yellowish-white */
            border-radius: 50%;
        }

        /* Smaller screens layout */
        @media screen and (max-width: 640px) {
            .service-item {
                flex-direction: column;
            }

            .service-price {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <section class="services-section">
        
        <div class="service-item">
            <div class="service-image">
                <img src="<?php echo "http://".$_SERVER['SERVER_NAME']."/Bricolini/Views/public/images/Hany-overall-cleaning-1.webp";?>">
            </div>
            <div class="service-description">
                <h3 class="service-title">Nettoyage à la journée pour une maison</h3>
                <p>Réservez un service de femme de menage pour une journée de nettoyage de votre maison</p>
            </div>
            <p class="service-price">250 DH</p>
            <div class="service-add"></div>
        </div>

        <div class="service-item">
            <div class="service-image">
            <img src="<?php echo "http://".$_SERVER['SERVER_NAME']."/Bricolini/Views/public/images/nettoyage-fin-chantier-agadir.jpg";?>">
            </div>
            <div class="service-description">
                <h2 class="service-title">Nettoyage fin de chantier appartement</h2>
                <p>Nettoyage des murs, plafonds, sols, vitres, armoires, tapis et dépoussiérage complet</p>
            </div>
            <p class="service-price">500 DH</p>
            <div class="service-add"></div>
        </div>

        <div class="service-item">
            <div class="service-image">
            <img src="<?php echo "http://".$_SERVER['SERVER_NAME']."/Bricolini/Views/public/images/nettoyage-fin-chantier-agadir.jpg";?>">
            </div>
            <div class="service-description">
                <h2 class="service-title">Nettoyage fin de chantier villa</h2>
                <p>Nettoyage des murs, plafonds, sols, vitres, armoires, tapis et dépoussiérage complet</p>
            </div>
            <p class="service-price">1000 DH</p>
            <div class="service-add"></div>
        </div>



    </section>

</body>
</html>
