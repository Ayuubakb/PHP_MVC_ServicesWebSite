<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Traitement de jardin</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/styleoffre.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>
    <section class="services-section">
    <div class="dropdown active">Traitement de jardin</div>
    <div class="content">

    <?php foreach ($Services as $service): ?>
        <form id="form-<?= $service['id'] ?>" method="post" class="ajax-form">
            <div class="service-item sec">
                <div class="service-image">
                    <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/Bricolini/Views/public/images/<?= $service['image'] ?>">
                </div>
                <div class="service-description">
                    <h2 class="service-title"><?= $service['Nom'] ?></h2>
                    <p><?= $service['Description'] ?></p>
                </div>
                <div>
                <p class="service-price"><?= $service['Prix'] ?> DH</p>
                <input type="hidden" name="Id_S" value="<?= $service['id'] ?>">
                <input type="hidden" name="Date_reserv" value="<?= date('Y-m-d') ?>">
                <input type="hidden" name="Id_C" value="1">
                <input type="hidden" name="Statuts" value="0">
                <button class="reserve-button">Réserver</button>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

        </div>

    </section>

<?php include 'Views/Components/Footer.php'; ?>

<div id="notificationModal" style="display:none; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; padding: 20px; background-color: white; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <p id="notificationMessage" style="margin: 0;"></p>
        <button onclick="document.getElementById('notificationModal').style.display='none'" style="margin-top: 10px; padding: 5px 10px; border: none; background-color: #007BFF; color: white; border-radius: 5px; cursor: pointer;">Close</button>
</div>

<script src="http://localhost/Bricolini/Views/public/js/Service.js"></script>
</body>
</html>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/reservationHandler.php'; ?>
