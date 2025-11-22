<?php

/**
 * CRUD FUNCTIONS
 */
function create_uid()
{
	// read uid
	$uids = read_uid();

	// modify uid
	while (true) {
		$new_uid = generate_uid();
		if (array_search($new_uid, $uids) === false) {
			// generated uid is unique in this section
			$uids[] = $new_uid;
			break;
		}
		// if generated uid is not unique, start over and generate a new one
	}

	// save uid
	$path = "database/uids";
	file_put_contents($path, serialize($uids));
	return $new_uid;
}
function read_uid()
{
	// file path
	$path = "database/uids";

	// create file if there is none
	if (!file_exists($path)) {
		file_put_contents($path, serialize([]));
	}

	// read and return the content of file
	return unserialize(file_get_contents($path));
}
function update_uid() {}
function delete_uid() {}

/**
 * MISC FUNCTIONS
 */

function generate_uid()
{
	return generate_random_text(8) . "-" . generate_random_text(4) . "-" . generate_random_text(4) . "-" . generate_random_text(4) . "-" . generate_random_text(12);
}
function generate_random_text($length)
{
	$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
	$text = "";
	for ($i = 0; $i < $length ?? 1; $i++) {
		$char = substr($characters, rand(0, 35), 1);
		$text = $text . $char;
	}
	return $text;
}
