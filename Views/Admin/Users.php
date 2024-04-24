<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <?php
    // Include database connection or any necessary files
    require_once 'db_connection.php'; // Assuming you have a file for database connection
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

        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .user-table th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .user-table th:hover {
            background-color: #ddd;
        }

        .user-table tr {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .user-table tr:hover {
            background-color: #f5f5f5;
        }

        .delete-button {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #d9482e;
        }
    </style>
</head>
<?php
require_once 'assets.php'; // Include the assets file

// Generate the header
generateHeader();
?>
<body>
<div class="container">
    <h1>All Users</h1>

    <!-- Filter/Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" onkeyup="filterUsers()" placeholder="Search for users...">
    </div>

    <!-- Clients Table -->
    <div class="users-section">
        <h2>Clients</h2>
        <table id="clientsTable" class="user-table">
            <tr>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Address</th>
                <th onclick="sortTable(2)">Telephone</th>
               
            </tr>
            <?php foreach ($users['clients'] as $client): ?>
                <tr>
                    <td><?php echo $client['FirstName'] . ' ' . $client['LastName']; ?></td>
                    <td><?php echo $client['Address']; ?></td>
                    <td><?php echo $client['Telephone']; ?></td>
                   
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Partenaires Table -->
    <div class="users-section">
        <h2>Partenaires</h2>
        <table id="partenairesTable" class="user-table">
            <tr>
                <th onclick="sortTable(3)">Name</th>
                <th onclick="sortTable(4)">Metier</th>
                <th onclick="sortTable(5)">Ville</th>
               
            <?php foreach ($users['partenaires'] as $partenaire): ?>
                <tr>
                    <td><?php echo $partenaire['FirstName'] . ' ' . $partenaire['LastName']; ?></td>
                    <td><?php echo $partenaire['Metier']; ?></td>
                    <td><?php echo $partenaire['Ville']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<!-- Script for filtering users -->
<script>
    function filterUsers() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("clientsTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        table = document.getElementById("partenairesTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Function to sort the table by column
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementsByClassName("user-table")[0];
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

   

</script>
<?php
generateFooter()
?>
</body>
</html>
