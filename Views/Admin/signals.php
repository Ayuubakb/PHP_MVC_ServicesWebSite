<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reclamations</title>
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

        .reclamation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .reclamation-table th, .reclamation-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .reclamation-table th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .reclamation-table th:hover {
            background-color: #ddd;
        }

        .reclamation-table tr {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .reclamation-table tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .action-buttons button {
            margin: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .ignore-button {
            background-color: #ff6347;
            color: #fff;
        }

        .ignore-button:hover {
            background-color: #d9482e;
        }

        .accept-button {
            background-color: #4caf50;
            color: #fff;
        }

        .accept-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>All Reclamations</h1>

    <!-- Reclamations Table -->
    <!-- Reclamations Table -->
<div class="reclamation-section">
    <table id="reclamationsTable" class="reclamation-table">
        <tr>
            <th>ID</th>
            <th>Type of reclamed</th>
            <th>Date of Reclamation</th>
            <th>Status</th>
            <th>Reclaimed ID</th>
            <th>Motif</th>
            <th>Reclaimer ID</th>
            <th>Reclaimer Type</th>
            <th>Actions</th> <!-- New column for actions -->
        </tr>
        <?php foreach ($signals as $reclamation): ?>
            <tr>
                <td><?php echo $reclamation['id']; ?></td>
                <td><?php echo $reclamation['type']; ?></td>
                <td><?php echo $reclamation['dateReclamations']; ?></td>
                <td><?php echo $reclamation['status']; ?></td>
                <td><?php echo $reclamation['Id_T']; ?></td>
                <td><?php echo $reclamation['motif']; ?></td>
                <td><?php echo $reclamation['id_Reclameur']; ?></td>
                <td><?php echo $reclamation['type_reclameur']; ?></td>
                <td class="action-buttons">
    <form action="handleReclamationAction" method="post"> <!-- Updated form action -->
        <input type="hidden" name="reclamationId" value="<?php echo $reclamation['id']; ?>">
        <input type="hidden" name="reclaimerId" value="<?php echo $reclamation['Id_T']; ?>">
        <input type="hidden" name="reclaimerType" value="<?php echo $reclamation['type']; ?>">
        <button type="submit" name="action" value="ignore" style="background-color:red">Ignore</button>
        <button type="submit" name="action" value="delete" style="background-color:green">Accept</button>
    </form>
</td>

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
