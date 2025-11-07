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
		file_put_contents($path, "");
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
	// check for access
	if (!is_writable('tasks/')) {
		return false;
	}

	return file_put_contents($path, "");
}
