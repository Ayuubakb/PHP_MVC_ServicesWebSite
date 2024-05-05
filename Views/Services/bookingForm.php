<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        body {
            background-color: #FBF6EE; 
            color: #65B741; 
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        form {
            background-color: #C1F2B0; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        label {
            font-weight: bold;
            color: #65B741; 
        }
        input[type="date"],
        input[type="number"],
        button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 2px solid #65B741; 
            border-radius: 5px;
        }
        button {
            background-color: #FFB534; 
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #65B741; 
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.ajax-form').on('submit', function(e) {
                var currentDate = new Date().toISOString().split('T')[0]; 
                var selectedDate = $('#date').val();
                if (selectedDate < currentDate) {
                    alert('vous ne pouvez pas réserver une date passée');
                    e.preventDefault(); 
                }
            });
        });
    </script>
</head>
<body>
    <?php include 'Views/Components/Nav.php'; ?>

    <div class="container">
    <form method="post" action="http://localhost/Bricolini/Views/Services/reservationHandler.php" class="ajax-form">
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="Date_reserv" id="date" required>
        </div>
        <div class="form-group">
            <label for="hours-from">Heure de début:</label>
            <input type="time" name="hours_from" id="hours-from" required>
        </div>
        <div class="form-group">
            <label for="hours-to">Heure de fin:</label>
            <input type="time" name="hours_to" id="hours-to" required>
        </div>
        <input type="hidden" name="Id_S" value="<?= htmlspecialchars($_POST['Id_S']); ?>">
        <input type="hidden" name="Statuts" value="0">
        <button type="submit" class="submit-button">Reserver</button>
    </form>
</div>


    <?php include 'Views/Components/Footer.php'; ?>
</body>
</html>
