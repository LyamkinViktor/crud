<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>User</title>
</head>
<body>
	<h2>User information</h2>
	<?php if (!empty($neededUser)): ?>
        <div>Login: <?php echo $neededUser['login']; ?></div>

		<div>First name: <?php echo $neededUser['firstName']; ?></div>

		<div>Last name: <?php echo $neededUser['lastName']; ?></div>

		<div>Gender: <?php echo $neededUser['gender']; ?></div>

		<div>Date Of Birth: <?php echo $neededUser['birthDate']; ?></div>

		<hr>

		<p><a href="/index.php?action=edit&id=<?php echo $neededUser['id']; ?>">Editing user</a></p>
		<p><a href="/index.php?action=delete&id=<?php echo $neededUser['id']; ?>">Delete user</a></p>
        <p><a href="/index.php">Return to the list</a></p>
	<?php endif; ?>
</body>
</html>