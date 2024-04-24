<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Comments</title>
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

        .comment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .comment-table th, .comment-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .comment-table th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .comment-table th:hover {
            background-color: #ddd;
        }

        .comment-table tr {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .comment-table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<?php
require_once 'assets.php'; // Include the assets file

// Generate the header
generateHeader();
?>
<div class="container">

    <h1>All Comments</h1>

    <!-- Filter/Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" onkeyup="filterComments()" placeholder="Search for comments...">
    </div>

    <!-- Comments Table -->
    <div class="comments-section">
        <table id="commentsTable" class="comment-table">
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Rating</th>
                <th>Date Posted</th>
                <th>Publisher</th>
                <th>Published</th>
            </tr>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?php echo $comment['id']; ?></td>
                    <td><?php echo $comment['message']; ?></td>
                    <td><?php echo $comment['Rating']; ?></td>
                    <td><?php echo $comment['Date_post']; ?></td>
                    <td><?php echo $comment['publisher']; ?></td>
                    <td><?php echo $comment['published'] ? 'Yes' : 'No'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<!-- Script for filtering comments -->
<script>
    function filterComments() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("commentsTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Index 1 for message column
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
</script>
<?php

// Generate the header
generateFooter();
?>
</body>
</html>
