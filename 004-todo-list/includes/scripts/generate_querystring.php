<?php
function generate_querystring($key, $value)
{
	// move query data from $_GET to a new array to avoid unwanted changes on $_GET
	$queries = $_GET;
	$queries[$key] = $value;
	ksort($queries);

	// generate new querystring
	$querystring = "?";
	foreach ($queries as $key => $value) {
		$querystring = $querystring . "$key=$value&";
	}
	$querystring = substr($querystring, 0, strlen($querystring) - 1);

	return $querystring;
}
