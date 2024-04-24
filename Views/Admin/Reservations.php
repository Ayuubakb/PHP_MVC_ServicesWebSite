<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reservations</title>
    <?php require_once 'db_connection.php'; ?>
    <?php require_once 'assets.php'; // Include the assets file

    // Generate the header
    generateHeader();
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .reservation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .reservation-table th, .reservation-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .reservation-table th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .reservation-table th:hover {
            background-color: #ddd;
        }

        .reservation-table tr {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .reservation-table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>All Reservations</h1>

    <!-- Reservations Table -->
    <div class="reservation-section">
        <table id="reservationsTable" class="reservation-table">
            <tr>
                <th>ID</th>
                <th>Service ID</th>
                <th>Client ID</th>
                <th>Date Reserved</th>
                <th>Status</th>
            </tr>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['Id_S']; ?></td>
                    <td><?php echo $reservation['Id_C']; ?></td>
                    <td><?php echo $reservation['Date_reserv']; ?></td>
                    <td><?php echo $reservation['Statuts']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
<?php 
generateFooter();
?>
</html>
