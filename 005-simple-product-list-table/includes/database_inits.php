<?php

mysqli_report(MYSQLI_REPORT_ERROR);
$cnn = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); // connection is closed in footer

if (!$cnn) {
	include("construction.html");
	global $cnn;
	mysqli_close($cnn);
	exit;
}
