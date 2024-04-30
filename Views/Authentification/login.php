<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../public/style/Style.css">
</head>

<body>
<div class="welcome-message">
        <h1>Bricoliini</h1>
        <hr>
    </div>
    
    <div class="login-container">
        <form action="/user/login" method="post" class="login-form">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

