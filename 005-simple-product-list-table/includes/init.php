<?php

// defining what page we are in now
$page = explode('/', $_SERVER['REQUEST_URI'])[2];
$on_home_page = ($page === "index.php" || $page === "");

// session codes
session_start();

// date codes
include_once('jdf.php');
date_default_timezone_set('Asia/Tehran');
