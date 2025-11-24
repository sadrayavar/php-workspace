<?php

// CRUD
function create_task($title, $status, $progress, $date)
{
	// read tasks
	$tasks = read_task();

	// add task
	array_unshift(
		$tasks,
		[
			'title' => $title,
			'create_time' => time(),
			'status' => $status,
			'progress' => $progress,
			'date' => $date,
			'id' => create_uid()
		]
	);

	// sort tasks by the date they made
	usort(
		$tasks,
		function ($arr, $usort) {
			return $usort['create_time'] <=> $arr['create_time'];
		}
	);

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
		// search for task
		for ($i = 0; $i < count($tasks); $i++) {
			$task = $tasks[$i];
			if ($task['id'] === $uid) {
				// return the expected task
				return $task;
			}
		}
		// task doesn't exist
		return false;
	} else {
		// return all tasks of this user
		return $tasks;
	}
}
function update_task($uid, $title, $status, $progress, $date)
{
	$tasks = read_task();
	for ($i = 0; $i < count($tasks); $i++) {
		if ($tasks[$i]['id'] === $uid) {
			$tasks[$i]['title'] = $title;
			$tasks[$i]['status'] = $status;
			$tasks[$i]['progress'] = $progress;
			$tasks[$i]['date'] = $date;

			$path = get_task_file_path();
			return file_put_contents($path, serialize($tasks));
		}
	}

	// for some reason, given uid was not in the database
	return false;
}
function delete_task($uid)
{
	$tasks = read_task();
	$tasks = array_filter($tasks, fn($task) => $task['id'] !== $uid);

	$path = get_task_file_path();
	return file_put_contents($path, serialize($tasks));
}

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
function remaining_days($datetime)
{
	$date_timestamp = strtotime($datetime);
	$diff = $date_timestamp - time(); // in seconds
	$days_left = $diff / 60 / 60 / 24;
	return $days_left;
}
function get_tasks_status()
{
	$status = [
		'queue' => 0,
		'doing' => 0,
		'done' => 0,
		'expire' => 0,
	];

	foreach (read_task() as $task) {
		$status[$task['status']]++;
	}

	return $status;
}
