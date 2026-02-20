<?php

function generate_querystring($key_value_pairs = [])
{
	// move query data from $_GET to a new array to avoid unwanted changes on $_GET
	$queries = $_GET;
	foreach ($key_value_pairs as $key => $value) {
		$queries[$key] = $value;

		if (is_null($value)) {
			unset($queries[$key]);
		}
	}
	ksort($queries);

	// generate new querystring
	$querystring = "?";
	foreach ($queries as $key => $value) {
		$querystring = $querystring . "$key=$value&";
	}

	// remove the last &
	$querystring = substr($querystring, 0, strlen($querystring) - 1);

	return $querystring;
}

function redirect($url)
{
	header("Location: $url");
	exit;
}

function save_log($message)
{
	$log =  date('Y-m-d H:i:s | ', time()) . $message . PHP_EOL;
	file_put_contents('logs.txt', $log, FILE_APPEND);
}

function upload_image_to_server($file_data)
{
	// root directory path on server
	$root = explode(DIRECTORY_SEPARATOR, __DIR__);
	$root = array_slice($root, 0, 4); // (hard coded)
	$root = implode(DIRECTORY_SEPARATOR, $root);

	// create directory for products images if it doesn't exist
	$image_directory = $root . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "product_images";
	if (!file_exists($image_directory)) mkdir($image_directory);

	// rename image file
	$file_format = explode("/", $file_data['type'])[1];
	$file_name = (string) time() . "." . $file_format;

	// move the image to image folder
	$image_path_on_server = $image_directory . DIRECTORY_SEPARATOR . $file_name;
	move_uploaded_file($file_data['tmp_name'], $image_path_on_server);

	// root URL path
	$protocol = $_SERVER['REQUEST_SCHEME'];
	$host = $_SERVER['HTTP_HOST'];
	$url = "$protocol://$host/005-simple-product-list-table/images/product_images/$file_name";
	return $url;
}

function delete_image_on_server($path)
{
	$path = explode("/", $path);
	$path = array_slice($path, 3, count($path) - 3);
	array_unshift($path, "..");
	$path = implode(DIRECTORY_SEPARATOR, $path);

	if (file_exists($path)) {
		return unlink($path);
	}
}

function error_translate($message)
{
	switch ($message) {
		case "Duplicate entry 'Laptop Stand Aluminum' for key 'products.title'":
			if (explode(" ", $message)[0] === 'Duplicate'); {
				$temp = explode("'", $message);
				return "نام $temp[1] قبلا استفاده شده است.";
			}
	}
}

function my_to_jalali($gregorian_date)
{
	$year = (int) substr($gregorian_date, 0, 4);
	$month = (int) substr($gregorian_date, 5, 2);
	$day = (int) substr($gregorian_date, 8, 2);

	return gregorian_to_jalali($year, $month, $day, "/");
}
