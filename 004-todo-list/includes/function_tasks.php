<?php

// CRUD
function create_task($title, $status, $progress, $date)
{
	// read tasks
	$tasks = read_task();

	// add task
	$tasks[] = [
		'title' => $title,
		'status' => $status,
		'progress' => $progress,
		'date' => $date,
	];

	// write tasks
	$path = get_task_file_path();
	return file_put_contents($path, serialize($tasks));
}
function read_task()
{
	// file path
	$path = get_task_file_path();

	// create file if there is none
	if (!file_exists($path)) {
		create_task_file($path);
		return [];
	}

	$tasks = file_get_contents($path);
	$tasks = unserialize($tasks);

	return $tasks;
}
function update_task() {}
function delete_task() {}

// misc
function get_task_file_path()
{
	// create file path
	$username = read_user()['username'];
	$path = "tasks/$username.tasks";
	return $path;
}
function create_task_file($path)
{
	// get folder path
	$folder_path = explode("/", $path);
	array_pop($folder_path);
	$folder_path = implode("/", $folder_path);

	// check for folder access
	if (!is_writable($folder_path)) {
		return false;
	}

	// create folder if it doesnt exist
	if (!file_exists($folder_path)) {
		mkdir(directory: $folder_path, recursive: true);
	}

	// create file
	return file_put_contents($path, "",);
}
