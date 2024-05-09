<?php

// Function to generate the header
function generateHeader() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <!-- Inline CSS styles -->
        <style>
            /* Styling for navigation */
            nav {
                background-color: #333;
                color: #fff;
                padding: 0px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            nav ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                display: flex;
            }

            nav ul li {
                margin-right: 20px;
            }

            nav ul li a {
                color: #fff;
                text-decoration: none;
            }

            nav ul li a:hover {
                text-decoration: underline;
            }

            /* Styling for logo */
            .logo img {
                width: 80px; /* Adjust the width as needed */
                height: auto;
            }
            
            /* Footer styles */
            footer {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
            }

            footer p {
                margin: 0;
            }
        </style>
        <!-- Link to Chart.js library for charts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav>
            <?php
              if(isset($_SESSION['user_id'])){
                $islogged=true;
                if(!strcmp($_SESSION['user_type'],'client')){
                    $type='client';
                }else if(!strcmp($_SESSION['user_type'],'partenaire')){
                    $type="partenaire";
                }else{
                    $type="admin";
                }
            }else{
                $islogged=false;
            }
            ?>
            <div class="logo">
                <img src="http://localhost/bricolini/Views/public/images/logo.png" alt="Logo">
            </div>
            <ul>
                <li><a href="http://localhost/bricolini/admin">Home</a></li>
                <li><a href="http://localhost/bricolini/admin/users">Users</a></li>
                <li><a href="http://localhost/bricolini/admin/comments">Comments</a></li>
                <li><a href="http://localhost/bricolini/admin/Services">services</a></li>
                <li><a href="http://localhost/bricolini/admin/Reservations">Reservations</a></li>
                <li><a href="http://localhost/bricolini/admin/signals">Reclamations</a></li>
                <li><a href="http://localhost/bricolini/Authentification/logout">LogOut</a></li>

            </ul>
        </nav>
    <?php
}

// Function to generate the footer
function generateFooter() {
    ?>
        <!-- Footer -->
        <footer>
            <p>&copy; <?php echo date('Y'); ?> BRICOLINI SARL R</p>
        </footer>
    </body>
    </html>
    <?php
}

?>
