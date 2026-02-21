<?php

// remove query string if there is any
$request_uri = $_SERVER['REQUEST_URI'];
if ($query_pos = strpos($request_uri, "?")) {
	$request_uri = substr($request_uri, 0, $query_pos);
}

//define what page we are in now
$uri_last_lart = explode('/', $request_uri)[2];
$on_home_page = ($uri_last_lart === "index.php" || $uri_last_lart === ""); //check if final part is empty (index.php) or not
$on_modify_page = isset($_GET['product_title']); // weather we add a product or modify it

// date
include_once('jdf.php');
date_default_timezone_set('Asia/Tehran');

// configurations
include_once("confs.php");

// include commonly used functions
include_once("common_funcs.php");

// mysql
include_once("database_inits.php");

// product
include_once("product_create.php");
include_once("product_delete.php");
include_once("product_read.php");
include_once("product_update.php");

// form processing
include_once("form_process.php");