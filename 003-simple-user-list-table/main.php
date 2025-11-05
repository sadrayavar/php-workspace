<?php

// includes
include "generate_querystring.php";

// global data
$users = include 'data.php';
const USER_NUM_IN_PAGE = 2;

// sort data 
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'نزولی';
usort(
	$users,
	function ($arr, $usort) use ($sortOrder) {
		$is_descend = $sortOrder === "نزولی" ? -1 : 1;
		return $is_descend * ($arr['age'] <=> $usort['age']);
	}
);

// pagination navigation
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$last_page = (int) ceil(count($users) / USER_NUM_IN_PAGE);

// making sure client is in the range
$current_page = $current_page > $last_page ? $last_page : $current_page;
$current_page = $current_page < 1 ? 1 : $current_page;

// paginate data
$page_users = array_slice($users, ($current_page - 1) * USER_NUM_IN_PAGE, USER_NUM_IN_PAGE);