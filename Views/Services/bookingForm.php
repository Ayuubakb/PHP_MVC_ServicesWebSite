<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/styleoffre.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php include 'Views/Components/Nav.php'; ?>

<section class="form-section">
    <div class="container">
        <form method="post" action="http://localhost/Bricolini/Views/Services/reservationHandler.php" class="ajax-form">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="Date_reserv" id="date" required>
            </div>
            <div class="form-group">
                <label for="hours">Nombre d'heures:</label>
                <input type="number" name="hours" id="hours" min="1" required>
            </div>
            <input type="hidden" name="Id_S" value="<?= htmlspecialchars($_POST['Id_S']); ?>">
            <input type="hidden" name="Id_C" value="1"><!-- id de client -->
            <input type="hidden" name="Statuts" value="0">
            <button type="submit" class="submit-button">Submit Reservation</button>
        </form>
    </div>
</section>

<?php include 'Views/Components/Footer.php'; ?>
</body>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/Bricolini/Views/Services/reservationHandler.php'; ?>