<?php

mysqli_report(MYSQLI_REPORT_ERROR);
$cnn = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); // connection is closed in footer

if (!$cnn) {
	save_log(mysqli_connect_error());
	include("construction.html");
	exit;
}

function cnn()
{
	global $cnn;
	return $cnn;
}

function fetch_query($query, $type = "select")
{
	// fetch results
	$results = @mysqli_query(cnn(), $query);

	// error handeling
	if (!$results) {
		$error_message = mysqli_error(cnn());
		save_log($error_message);
		return $error_message;
	}

	// return records
	if ($type === "select") {
		return mysqli_fetch_all($results, MYSQLI_ASSOC);
	} else if ($type === "update" || $type === "delete") {
		return $results;
	} else if ($type === "insert") {
		return mysqli_insert_id(cnn());
	}
}

function is_sql_injection($numeric_args = null, $string_args = null)
{
	// check string args
	foreach ([...$string_args] as $arg) {
		if (isset($arg)) {
			foreach (SQL_INJECTION_CHARS as $dngr_char) {
				if (strpos($arg, $dngr_char)) return true;
			}
		}
	}

	// check numeric args
	foreach ([...$numeric_args] as $arg) {
		if (isset($arg)) {
			if (is_nan($arg)) return true;
		}
	}

	return false;
}
