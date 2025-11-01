<?php

// global data
$users = include 'data.php';
const USER_NUM_IN_PAGE = 2;

// pagination navigation
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$last_page = (int) ceil(count($users) / USER_NUM_IN_PAGE);

// making sure client is in the range
$current_page = $current_page > $last_page ? $last_page : $current_page;
$current_page = $current_page < 1 ? 1 : $current_page;

// pagination data
$page_users = array_slice($users, ($current_page - 1) * USER_NUM_IN_PAGE, USER_NUM_IN_PAGE);
