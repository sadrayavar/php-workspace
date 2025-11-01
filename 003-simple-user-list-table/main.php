<?php

$users = include 'data.php';

// pagination
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$last_page = (int) ceil(count($users) / 2);
