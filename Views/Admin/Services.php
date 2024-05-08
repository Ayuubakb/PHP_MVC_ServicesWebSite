<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Services</title>
    <?php require_once 'db_connection.php'; 
    require_once 'assets.php'; // Include the assets file

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

        .service-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .service-table th, .service-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .service-table th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .service-table th:hover {
            background-color: #ddd;
        }

        .service-table tr {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .service-table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>All Services</h1>

    <!-- Services Table -->
    <div class="service-section">
        <table id="servicesTable" class="service-table">
            <tr>
                <th>ID</th>
                <th>Provider ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Number of Orders</th>
                <th>Image</th>
                <th>Category</th>
                <th>Subcategory</th>
            </tr>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['Id_P']; ?></td>
                    <td><?php echo $service['Nom']; ?></td>
                    <td><?php echo $service['Description']; ?></td>
                    <td><?php echo $service['Prix']; ?></td>
                    <td><?php echo $service['Note']; ?></td>
                    <td><?php echo $service['Nbr_commande']; ?></td>
                    <td><img src="http://localhost/bricolini/Views/public/images/<?php echo $service['image']; ?>" alt="Service Image" style="width: 100px; height: auto;"></td>
                    <td><?php echo $service['categorie']; ?></td>
                    <td><?php echo $service['sousCategorie']; ?></td>
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
