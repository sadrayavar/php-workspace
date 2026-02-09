<?php

function cnn()
{
	global $cnn;
	return $cnn;
}

function fetch_query($query)
{
	// fetch results
	$results = @mysqli_query(cnn(), $query);

	// error handeling
	if (!$results) {
		$error_message = mysqli_error(cnn());
		save_log($error_message);
		return [];
	}

	// return records
	return @mysqli_fetch_all($results, MYSQLI_ASSOC);
}

function read_products($page = null, $sort = null, $sort_dir = null)
{
	// check for sql injection
	$is_attack = false;
	if (is_null(array_search($sort, [...ALLOWED_KEYWORDS, null]))) $is_attack = true;
	if (is_null(array_search($sort_dir, ["asc", "desc", null]))) $is_attack = true;
	if (is_nan($page)) $is_attack = true;
	if ($is_attack) die("bad bad bad!");

	// create query
	$sort_clause = "ORDER BY $sort $sort_dir";
	$paginate_clause = "LIMIT " . PER_PAGE . " OFFSET " . ($page - 1) * PER_PAGE;
	$query = "SELECT * FROM products WHERE `state`<>'deleted' $sort_clause $paginate_clause";

	return fetch_query($query);
}

function total_product_num()
{
	$query = "SELECT COUNT(*) AS total_num FROM products WHERE `state`<>'deleted'";
	$records = fetch_query($query);
	return (int) $records[0]['total_num'];
}
