<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nettoyage de canapés</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/styleoffre.css">
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>
    <section class="services-section">
    <div class="dropdown active">Nettoyage de canapés</div>
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
                <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
                <!--<input type="hidden" name="client_id" value="<?= //$_SESSION['id'] ?>">-->
                <input type="hidden" name="client_id" value="1">
                <input type="hidden" name="staus" value="0">
                <button class="reserve-button">Réserver</button>
            </div>
    <?php endforeach; ?>

        </div>

    </section>

<?php include 'Views/Components/Footer.php'; ?>
</body>
</html>
