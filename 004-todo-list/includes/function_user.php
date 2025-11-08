<?php

// CRUD
function create_user($username, $password, $name, $family, $phone, $birthdate, $avatar)
{
	// if user exists
	if (read_user($username) !== false) {
		return false;
	}

	// append user
	$users = read_user();
	$users[$username] = [
		"password" => $password,
		"name" => $name,
		"family" => $family,
		"phone" => $phone,
		"birthdate" => $birthdate,
		"avatar" => $avatar,
		"tasks" => [],
	];

	// save on file
	$path = "database/users.db";
	file_put_contents($path, serialize($users));

	return $username;
}
function read_user($username = null)
{
	/*
	$user_data = isset($_COOKIE['user']) ? $_COOKIE['user'] : $_SESSION['user'];
	return unserialize($user_data);
	*/

	// create database file if there is none
	$path = "database/users.db";
	if (!file_exists($path)) {
		file_put_contents($path, serialize([]));
	}

	// extract users data from file
	$users = unserialize(file_get_contents($path));

	if (isset($username)) {
		if (isset($users[$username])) {
			// return the expected user
			return $users[$username];
		} else {
			// expected user doesnt exist
			return false;
		}
	} else {
		// return all users
		return $users;
	}
}
function update_user() {}
function delete_user() {}

// misc
function check_credentials($username, $password)
{
	// username exist on database
	$retrieved_user = read_user($username);
	if ($retrieved_user !== false) {
		// password matchs with username
		if ($retrieved_user['password'] === $password) {
			return true;
		}
	}
	return false;
}
function logout_user()
{
	setcookie('user', '', 1);
	unset($_SESSION['user']);
}
function this_user()
{
	if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
		// get username and password from session or cookie
		$saved_user = unserialize(isset($_SESSION['user']) ? $_SESSION['user'] : $_COOKIE['user']);
	}

	return read_user($saved_user['username']);
}
