<?php

function generate_querystring($key_value_pairs)
{
	// move query data from $_GET to a new array to avoid unwanted changes on $_GET
	$queries = $_GET;
	foreach ($key_value_pairs as $key => $value) {
		$queries[$key] = $value;
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
