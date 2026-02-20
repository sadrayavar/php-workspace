<?php

function read_products($title = null, $page = null, $sort = [])
{
	// check for sql injection
	$numeric_args = [$page];
	$string_args = [$title, ...$sort];
	if (is_sql_injection($numeric_args, $string_args)) die("Try harder!");


	// create query
	$columns_we_want = "title, description, thumbnail, base_price, sale_price, stock, state, discount, created_at";
	$cond_clause = "WHERE `state`<>'deleted'" . (isset($title) ? " AND `title`='$title'" : "");
	$sort_clause = count($sort) > 0 ? "ORDER BY $sort[0] $sort[1]" : "";
	$paginate_clause =  isset($page) ? "LIMIT " . PER_PAGE . " OFFSET " . ($page - 1) * PER_PAGE : "";
	$query = "SELECT $columns_we_want FROM products $cond_clause $sort_clause $paginate_clause";

	return fetch_query($query);
}

function total_product_num()
{
	$query = "SELECT COUNT(*) AS total_num FROM products WHERE `state`<>'deleted'";
	$records = fetch_query($query);
	return (int) $records[0]['total_num'];
}
