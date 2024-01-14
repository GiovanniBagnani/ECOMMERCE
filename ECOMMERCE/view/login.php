<?php ?>
<html lang="">
<head>
    <title>
        pagina login
    </title>
    <style>
        body{
            font-family: Arial;
            background-color: #cccccc;
        }
    </style>
</head>

<body>
login page
<form action="../actions/login.php" method="POST">
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="Login"/>
</form>
</body>
</html>
