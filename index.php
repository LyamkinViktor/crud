<?php
session_start();

require_once __DIR__ . '/classes/Db.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Pagination.php';

$user = new User();

/**
 * if there is no session we redirect to login
 */
if (empty($_SESSION)) {
    header('Location: /login.php');
    exit();
}

/**
 * if there is session data -
 * we check it by the method 'check', in case of an error we redirect to the login
 */
if (isset($_SESSION['login']) && isset($_SESSION['pass'])){
	if ($user->check($_SESSION['login'], $_SESSION['pass']) === false){
		header('Location: /login.php');
		exit();
	}
}

/**
 * performing actions crud
 */
if (isset($_GET['action']))
{
	switch ($_GET['action']){
		case 'show':
			$id = (int)$_GET['id'];
			$neededUser = $user->findByID($id);
			include __DIR__ . '/templates/user.php';
			break;
		case 'edit':
            if (isset($_POST['save'])){
                $user->update($_REQUEST);
                header('Location: /index.php');
                exit();
            }
			$id = (int)$_GET['id'];
			$neededUser = $user->findByID($id);
			include __DIR__ . '/templates/edit.php';
            break;
		case 'add':
            if (isset($_POST['add'])){
                if (true == $user->add($_POST)) {
                    header('Location: /index.php');
                    exit();
                } else {
                    header('Location: /index.php?action=add&retry');
                    exit();
                }
            }
			include __DIR__ . '/templates/edit.php';
            break;
		case 'delete':
			$id = (int)$_GET['id'];
			$user->delete($id);
			header('Location: /index.php');
			exit();
	}
} else {
    /**
     * we display a list of registered users,
     * sort by login (optionally),
     * 2 users per page (optionally)
     */
    if (isset($_GET['page'])) {
        $page = htmlspecialchars((int)$_GET['page']);
    } else {
        $page = 1;
    }
    $pagination = new Pagination();
	$usersList = $pagination->paginate($page);
	$count = $pagination->countPages();
	require_once __DIR__ . '/templates/index.php';
}
