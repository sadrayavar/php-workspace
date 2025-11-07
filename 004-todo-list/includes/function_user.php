<?php

// CRUD
function create_user() {}
function read_user()
{
	$user_data = isset($_COOKIE['user']) ? $_COOKIE['user'] : $_SESSION['user'];
	return unserialize($user_data);
}
function update_user() {}
function delete_user() {}

// misc
function is_credential_ok($username, $password)
{
	// check credentials
	$users = include "includes/simple-login-form-users.php";
	$credential_ok = false;
	foreach ($users as $user) {
		if ($username === $user['username'] && $password === $user['password']) {
			$credential_ok = true;
			$this_user = $user;
			break;
		}
	}

	return $credential_ok;
}
function logout_user()
{
	setcookie('user', '', 1);
	unset($_SESSION['user']);
}
