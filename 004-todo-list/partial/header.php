<?php
include('includes/scripts/common.php');
session_start();

// logout user
if (isset($_GET['logout']) && $_GET['logout'] === "true") {
	setcookie('user', '', 1);
	unset($_SESSION['user']);
}

// redirect to login page if user is not logged in
if (!isset($_SESSION['user']) and !isset($_COOKIE['user'])) {
	redirect('login.php');
}

$temp = explode('/', $_SERVER['REQUEST_URI'])[2];
switch ($temp) {
	case 'change-password.php':
		$page_title = 'تغییر رمز عبور';
		break;
	case 'index.php':
		$page_title = 'پنل کاربری';
		break;
	case 'login.php':
		$page_title = 'ورود';
		break;
	case 'new.php':
		$page_title = 'وظیفه جدید';
		break;
	case 'profile.php':
		$page_title = 'پروفایل کاربر';
		break;
	case 'register.php':
		$page_title = 'ثبت نام';
		break;
	case 'tasklist.php':
		$page_title = 'لیست وظایف';
		break;

	default:
		$page_title = 'لیست وظایف';
		break;
}
?>
<!DOCTYPE html>
<html lang="fa">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo ($page_title . " | " . "همه چی آرومههه!") ?></title>
	<link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
	<link rel="stylesheet" href="css/panel.css">
</head>

<body>
	<div class="panel-container">
