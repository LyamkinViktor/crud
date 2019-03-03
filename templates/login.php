<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
</head>
<body>

<form action="/login.php" method="post">
    <label for="loginField">Enter your login</label>
    <div><input type="text" name="login" id="loginField"></div><br>
    <label for="passwordField">Enter your password</label>
    <div><input type="password" name="password" id="passwordField"></div>
    <p><button type="submit">Enter</button></p>
</form>

<?php
if (isset($message)) {
    echo $message;
} ?>

</body>
</html>