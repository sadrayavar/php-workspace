<?php

// includes
include "generate_querystring.php";

// global data
$users = include 'data.php';
const USER_NUM_IN_PAGE = 2;

// filtering based on status
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';
$users = array_filter($users, fn($user) => $filter_status === "all" || $user['status'] === $filter_status);

// filtering based on search field
$filter_search = isset($_GET['search']) ? $_GET['search'] : '';
$users = array_filter($users, function ($user) use ($filter_search) {
	$haystack = $user['name'] . $user['family'] . $user['phone'] . $user['age'];
	return strpos($haystack, $filter_search) !== false;
});


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
