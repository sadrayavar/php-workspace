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
	$querystring = substr($querystring, 0, strlen($querystring) - 1);

	return $querystring;
}
function redirect($url)
{
	header("Location: $url");
	exit;
}
