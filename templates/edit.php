<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editing</title>
</head>
<body>

<div>
    <?php if (!empty($neededUser)): ?>
		<form action="/index.php?action=edit&id=<?php echo $id; ?>" method="post">
    <?php else: ?>
		<form action="/index.php?action=add" method="post">
	<?php endif; ?>
        <p>
            <label for="loginField">Login</label>
            <input type="text" name="login" value="<?php if (!empty($neededUser)): echo $neededUser['login']; endif; ?>" id="loginField" required>
        </p>
        <?php if (empty($neededUser)): ?>
        <p>
            <label for="passwordField">Password</label>
            <input type="text" name="password" value="" id="passwordField" required>
        </p>
        <?php endif; ?>
        <p>
            <label for="nameField">First name</label>
            <input type="text" name="firstName" value="<?php if (!empty($neededUser)): echo $neededUser['firstName']; endif; ?>" id="nameField" required>
        </p>
        <p>
            <label for="lastNameField">Last name</label>
            <input type="text" name="lastName" value="<?php if (!empty($neededUser)): echo $neededUser['lastName']; endif; ?>" id="lastNameField" required>
        </p>
        <p>
            <label for="genderField">Gender</label>
            <select name="gender" required>
                <option <?php if (!empty($neededUser) && $neededUser['gender'] == 'Male') { ?> selected <?php } ?> value="Male">Male</option>
                <option <?php if (!empty($neededUser) && $neededUser['gender'] == 'Female') { ?> selected <?php } ?> value="Female">Female</option>
            </select>
        </p>
        <p>
            <label for="dateField">Date of Birth</label>
            <input type="date" name="dateOfBirth" value="<?php if (!empty($neededUser)) { echo $neededUser['birthDate']; } ?>" id="dateField" required>
        </p>
        <p>
            <?php if (!empty($neededUser)): ?>
	            <button type="submit" name="save">Save changes</button>
            <?php else: ?>
	            <button type="submit" name="add">Add user</button>
            <?php endif; ?>
        </p>
    </form>
</div>

<p>
    <?php if (isset($_GET['retry'])) {
        echo 'This user already exists!';
    } ?>
</p>

<a href="/index.php">Return to the list</a>

</body>
</html>