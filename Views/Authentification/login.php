<?php
    $err="";
    if(isset($msg)){
        $err=$msg;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
    <script src="https://kit.fontawesome.com/50cf27202e.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <?php  require('Views/Components/Nav.php'); ?>
    <section class="log">
        <div class="container">
            <h1>Login</h1>
            <?php echo !strcmp($err,"")?null :"<p class='errlog'>".$err."</p>";?>
            <form action="http://localhost/Bricolini/Authentification/login" method="POST">
                <div>
                    <label>Email : </label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div>
                    <label>Password : </label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Login" class="btn">
            </form>
        </div>
    </section>
</body>
</html>
