<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entretien de Gazon et Pelouse</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/styleoffre.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>
    <section class="services-section">
    <div class="dropdown active">Entretien de Gazon et Pelouse</div>
    <div class="content">

    <?php foreach ($Services as $service): ?>
        <form id="form-<?= $service['id'] ?>" method="post" class="ajax-form">
            <div class="service-item">
                <div class="service-image">
                    <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/Bricolini/Views/public/images/<?= $service['image'] ?>">
                </div>
                <div class="service-description">
                    <h2 class="service-title"><?= $service['Nom'] ?></h2>
                    <p><?= $service['Description'] ?></p>
                </div>
                <p class="service-price"><?= $service['Prix'] ?> DH</p>
                <input type="hidden" name="Id_S" value="<?= $service['id'] ?>">
                <input type="hidden" name="Date_reserv" value="<?= date('Y-m-d') ?>">
                <input type="hidden" name="Id_C" value="1">
                <input type="hidden" name="Statuts" value="0">
                <button class="reserve-button">Réserver</button>
            </div>
        </form>
    <?php endforeach; ?>

        </div>

    </section>

<?php include 'Views/Components/Footer.php'; ?>
<script src="http://localhost/Bricolini/Views/public/js/Service.js"></script>
</body>
</html>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/reservationHandler.php'; ?>
