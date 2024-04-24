<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cleaning Services Selection</title>
    <link rel="stylesheet" href="Views/public/style/Style.css">
    <link rel="stylesheet" href="../public/style/styleindex.css">
    <style>
        .service-card {
            width: 200px; 
            height: 250px;
            text-align: center;
            padding: 1rem;
            border: 1px solid #C1F2B0; 
            border-radius: 4px;
            margin: 0.5rem;
            transition: box-shadow 0.3s ease-in-out;
            background-color: #FFFFFF;
            /* align them left */
            display: inline-block;
        }
        .service-card:hover {
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            background-color: #FFB534; 
        }
        .service-card img {
            max-width: 100px;
            margin-bottom: 0.5rem;
        }
        .service-card h2 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .service-selection h1 {
            font-size: 2em; /* Sets the size of the title */
            font-weight: bold; /* Makes the title bold */
            margin-bottom: 0.5em;
            text-align: left; /* Align the text to the left */
            color: #000000; /* Sets the text color to black */
        }
        .service-selection p {
            font-size: 1em; /* Sets the size of the paragraph */
            margin-bottom: 1em;
            text-align: left; /* Align the text to the left */
            color: black; /* Sets the text color to blue */
        }
        .services-grid {
            display: flex; /* Use flexbox for horizontal alignment */
            flex-wrap: wrap; /* Allows multiple lines if needed */
            align-items: flex-start; /* Aligns items to the start of the flex container */
            justify-content: flex-start; /* Aligns items to the left side of the container */
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 1rem;
        }
        nav a { 
            text-decoration: none; 
            color: #65B741; 
        }
        h1, h2, p {
            color: #65B741; /* green text */
        }
        body {
            background-color: #FFFFFF; /* white background */
        }
        button {
            background-color: #FFB534; /* yellow button background */
            color: #FBF6EE; /* white text on buttons */
        }
        @media (max-width: 768px) {
            .services-grid {
                justify-content: center; /* Centers boxes on smaller screens */
            }
            .continue-button {
                text-align: center; /* Centers the button on smaller screens */
            }
        }


    </style>
</head>
<body>

    <?php include 'Views/Components/Nav.php'; ?>
    <main class="sec">
    <div class="service-container">
        <div class="service-selection">
            <h1>Choisissez votre service</h1>
            <p>Commencez par choisir le service qui correspond à vos besoins. Parcourez nos catégories de services et sélectionnez celui qui vous intéresse.</p>
        </div>
        <div class="services-grid">
            <!-- Display the services without the database-->

            <a href="Services/nettoyagedecanapes" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/nettoyage_canap.webp" alt="Couch Cleaning">
                <h2>Nettoyage de canapés</h2>
            </div>
            </a>

            <a href="Services/nettoyagedessurfaces" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/nettoyage_surfaces.webp" alt="Couch Cleaning">
                <h2>Nettoyage des surfaces</h2>
            </div>
            </a>

            <a href="Services/nettoyagegeneral" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/nettoyage_g.webp" alt="Couch Cleaning">
                <h2>Nettoyage général</h2>
            </div>
            </a>

            <a href="Services/entretiengazon" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/entretienGAZON.webp" alt="Couch Cleaning">
                <h2>Entretien de Gazon et Pelouse</h2>
            </div>
            </a>

            <a href="Services/traitementjardin" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/traitementjardin.webp" alt="Couch Cleaning">
                <h2>Traitement de jardin</h2>
            </div>
            </a>

            <a href="Services/plantationjardin" style="text-decoration: none; color: inherit;">
            <div class="service-card">
                <img src="Views/public/images/plantationjardin.webp" alt="Couch Cleaning">
                <h2>Plantation pour jardin</h2>
            </div>
            </a>

</div>
</main>
    <?php include 'Views/Components/Footer.php'; ?>
</body>
</html>