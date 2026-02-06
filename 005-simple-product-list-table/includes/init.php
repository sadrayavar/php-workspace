<?php

// defining what page we are in now
$page = explode('/', $_SERVER['REQUEST_URI'])[2];
$on_home_page = ($page === "index.php" || $page === "");

// configurations
include_once("confs.php");

// session
session_start();

// date
include_once('jdf.php');
date_default_timezone_set('Asia/Tehran');

// mysql
include_once("database_inits.php");

// product
include_once("product_funcs.php");
