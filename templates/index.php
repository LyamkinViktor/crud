<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>

<h2>Home page</h2>
<h4>list of registered users</h4>

<?php
foreach ($usersList as $user) { ?>
<p>
    <a href="/index.php?action=show&id=<?php echo $user['id']; ?>">
        <div>
            <?php echo $user['login']; ?>
        </div>
    </a>
<?php } ?>

<hr>

<?php
for ($i = 1; $i <= $count; $i++) { ?>
    <a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php } ?>

<p>
<a href="index.php?action=add">Add user</a>
</p>

<p>
<form action='/login.php' method='post'>
    <button type="submit" name="exit">Exit</button>
</form>
</p>

</body>
</html>