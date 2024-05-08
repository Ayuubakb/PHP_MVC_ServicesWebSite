<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        body {
            background-color: #FBF6EE; 
            color: #65B741; 
            min-height: 100vh;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
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
        h1 {
            text-align: center;
            color: #65B741; 
        }
        label {
            font-weight: bold;
            color: #65B741; 
        }
        input[type="date"],
        input[type="number"],
        .submit-button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 2px solid #65B741; 
            border-radius: 5px;
        }
        .submit-button {
            background-color: #FFB534; 
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-button:hover {
            background-color: #65B741; 
        }
        .errPlace {
            color: red;
            text-align: center;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.ajax-form').on('submit', function(e) {
                var currentDate = new Date().toISOString().split('T')[0]; 
                var selectedDate = $('#date').val();
                if (selectedDate < currentDate) {
                    document.getElementById("errorP").innerHTML='Vous ne pouvez pas réserver une date passée'
                    e.preventDefault(); 
                }
            });
        });
    </script>
</head>
<body>
    <h1>Page de reservation</h1>
    <p id="errorP" class="errPlace"></p>
    <div class="container">
        <form method="post" action="http://localhost/Bricolini/Views/Services/reservationHandler.php" class="ajax-form" id="formres">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="Date_reserv" id="date" required>
            </div>
            <div class="form-group">
                <label for="hours-from">Heure de début:</label>
                <input type="time" name="hours_from" id="hours_from" required>
            </div>
            <div class="form-group">
                <label for="hours-to">Heure de fin:</label>
                <input type="time" name="hours_to" id="hours_to" required>
            </div>
            <input type="hidden" name="Id_S" value="<?= $_POST['Id_S'] ?>">
            <input type="hidden" name="Statuts" value="0">
            <?php
                session_start();
                if(isset($_SESSION['user_id'])){
                    echo "<button type='submit' class='submit-button'>Reserver</button>";
                }else{
                    echo "<a href='http://localhost/Bricolini/Authentification/showLoginForm' class='submit-button'>Reserver</a>";
                }
            ?>
        </form>
    </div>
    <script>
        document.getElementById("formres").addEventListener("submit",async function(e) {
            e.preventDefault();
            let hto=document.getElementById("hours_to").value;
            let hfrom=document.getElementById("hours_from").value;
            hto=hto.split(":")[0]
            hfrom=hfrom.split(":")[0]
            if(parseInt(hto) > parseInt(hfrom)){
                const response = await fetch("http://localhost/Bricolini/Views/Services/reservationHandler.php", {
                    method: "POST",
                    body: new FormData(this)
                });
                await response.text().then(
                    (data)=>{
                        document.getElementById("errorP").innerHTML=data;
                    })
            }else{
                document.getElementById("errorP").innerHTML="Creneaux Horarire Absurde"
            }
        });
    </script>
</body>
</html>
