<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entretien de Gazon et Pelouse</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <style>
        body {
            background-color: #FFFFFF; /* Very light yellowish-white */
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
            color: #333;
        }

        .service-price {
            color: #FFB534;
            font-weight: bold;
            margin-right: 16px;
            font-size: 1.2rem;
        }

        .reserve-button {
            padding: 8px 16px;
            background-color: #65B741; /* Green background */
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Adjusting button for better visibility */
        .reserve-button:hover {
            background-color: #559F3B; /* Darker green for hover effect */
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
        .dropdown {
            cursor: pointer;
            padding: 10px;
            border: none;
            background: white;
            text-align: left;
            width: 100%;
            border-top: 1px solid #FFB534;
            border-bottom: 1px solid #FFB534;
        }
        .dropdown:after {
            content: '\25B2'; /* CSS code for the up arrow */
            float: right;
            color: #FFB534;
        }

        .dropdown.active:after {
            content: '\25BC'; /* CSS code for the down arrow */
        }

        .content {
            padding: 0 10px;
            max-height: none;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #FFF;
        }
        .title-container {
            background: #FFB534;
            color: #FFF;
            padding: 16px;
            border-radius: 16px;
            margin: 16px 0;
            text-align: center;
        }

        /* Adjust the colors accordingly */
        .service-title {
            color: #000; /* Black for title text */
            margin: 0;
        }
    </style>
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>
    <section class="services-section">
    <div class="dropdown active">Entretien de Gazon et Pelouse</div>
    <div class="content">

    <?php foreach ($Services as $service): ?>
            <div class="service-item">
                <div class="service-image">
                    <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/Bricolini/Views/public/images/<?= $service['image'] ?>">
                </div>
                <div class="service-description">
                    <h2 class="service-title"><?= $service['Nom'] ?></h2>
                    <p><?= $service['Description'] ?></p>
                </div>
                <p class="service-price"><?= $service['Prix'] ?> DH</p>
                <button class="reserve-button">Réserver</button>
            </div>
    <?php endforeach; ?>

        </div>

    </section>

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.querySelector('.dropdown');
                dropdown.addEventListener('click', function() {
                    this.classList.toggle('active');
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight){
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    } 
                });
            });
    </script>

<?php include 'Views/Components/Footer.php'; ?>
</body>
</html>
