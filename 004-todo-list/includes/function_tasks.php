<?php

// CRUD
function create_task($title, $status, $progress, $date)
{
	// read tasks
	$tasks = read_task();

	// add task
	$tasks[create_uid()] = [
		'title' => $title,
		'status' => $status,
		'progress' => $progress,
		'date' => $date,
	];

	// write tasks
	$path = get_task_file_path();
	return file_put_contents($path, serialize($tasks));
}
function read_task($uid = null)
{
	// create database file if there is none
	$path = get_task_file_path();
	if (!file_exists($path)) {
		create_task_file($path);
	}

	// extract tasks data from file
	$tasks = unserialize(file_get_contents($path));

	if (isset($uid)) {
		if (isset($tasks[$uid])) {
			// return the expected task
			return $tasks[$uid];
		} else {
			// expected task doesnt exist
			return false;
		}
	} else {
		// return all tasks of this user
		return $tasks;
	}
}
function update_task() {}
function delete_task() {}

// misc
function get_task_file_path()
{
	// create file path
	$username = this_user()['username'];
	$path = "database/tasks/$username.tasks";
	return $path;
}
function create_task_file($path)
{
	// get folder path
	$folder_path = explode("/", $path);
	array_pop($folder_path);
	$folder_path = implode("/", $folder_path);

	// create folder if it doesnt exist
	if (!file_exists($folder_path)) {
		mkdir(directory: $folder_path, recursive: true);
	}

	// create file
	return file_put_contents($path, serialize([]));
}
