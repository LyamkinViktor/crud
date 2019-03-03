<?php
session_start();

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Db.php';

/**
 * if the 'exit' button is pressed, we delete the session
 */
if (isset($_POST['exit'])) {
    session_unset();
    include __DIR__ . '/templates/login.php';
    exit;
}

$user = new User();

/**
 * check user login and password,
 * redirect to the main page or display an error message
 */
if (isset($_POST) && count($_POST) > 0){
	$login = htmlspecialchars(trim($_POST['login']));
	$pass = htmlspecialchars(trim($_POST['password']));
	if ($user->check($login, md5($pass)) === true){
		$_SESSION['login'] = $login;
		$_SESSION['pass'] = md5($pass);
		header('Location: /index.php');
		exit();
	} else {
		$message = 'Unable to log in!';
		session_destroy();
	}
}

/*
 * if the user has already logged in before - redirect to the main page
 */
if (isset($_SESSION['login']) && isset($_SESSION['pass'])){
	if ($user->check($_SESSION['login'], $_SESSION['pass']) === true){
		header('Location: /index.php');
		exit();
	}
}


include __DIR__ . '/templates/login.php';