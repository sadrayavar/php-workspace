<?php

mysqli_report(MYSQLI_REPORT_ERROR);
$cnn = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); // connection is closed in footer

if (!$cnn) {
	save_log(mysqli_connect_error());
	include("construction.html");
	exit;
}
