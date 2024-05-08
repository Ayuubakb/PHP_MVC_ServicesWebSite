<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nettoyage de canapés</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/styleoffre.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>
    <section class="services-section sec">
    <div class="dropdown active">Nettoyage de canapés</div>
    <div class="content">

    <?php foreach ($Services as $service): ?>
        <form id="form-<?= $service['id'] ?>" method="post" action=<?=isset($_SESSION['user_id'])?"http://localhost/Bricolini/Views/Services/bookingForm.php":"http://localhost/Bricolini/Authentification/showLoginForm"?>>
            <div class="service-item">
                <div class="service-image">
                    <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/Bricolini/Views/public/images/<?= $service['image'] ?>">
                </div>
                <div class="service-description">
                    <h2 class="service-title"><?= $service['Nom'] ?></h2>
                    <p><?= $service['Description'] ?></p>
                </div>
                <div class="priceReserve">
                    <p class="service-price"><?= $service['Prix'] ?> DH</p>
                    <input type="hidden" name="Id_S" value="<?= $service['id'] ?>">
                
                    <a href="http://localhost/Bricolini/Views/Services/bookingForm.php" style="text-decoration: none;">
                        <button class="reserve-button">Réserver</button>
                    </a>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

        </div>

    </section>

<?php include 'Views/Components/Footer.php'; ?>

</body>
</html>
