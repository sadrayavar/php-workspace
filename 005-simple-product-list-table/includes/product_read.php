<?php

function read_products($page, $filter = [], $sort = [])
{
	// check for sql injection
	$numeric_args = [$page];
	$string_args = [...$sort];
	foreach ($filter as $clm) {
		if (is_numeric($clm)) {
			array_push($numeric_args, $clm);
		} else {
			array_push($string_args, $clm);
		}
	}
	if (is_sql_injection($numeric_args, $string_args)) die("Try harder!");


	// state filtering logic
	$cond_clause = "WHERE ";
	if (isset($filter['state']) && $filter['state'] !== "") {
		$state = $filter['state'];
		$cond_clause .= "state='$state'";
	} else {
		$cond_clause .= "`state`<>'deleted'";
	}

	// title filtering logic
	if (isset($filter['title']) && $filter['title'] !== "") {
		$title = $filter['title'];
		$cond_clause .= " AND title LIKE '%$title%'";
	}

	// price filtering logic
	if (isset($filter['min_price']) && $filter['min_price'] !== "" && isset($filter['max_price']) && $filter['max_price'] !== "") { // min and max
		$min_price = $filter['min_price'];
		$max_price = $filter['max_price'];
		$cond_clause .= " AND sale_price BETWEEN $min_price AND $max_price";
	} else if (isset($filter['min_price']) && $filter['min_price'] !== "") { // only min
		$min_price = $filter['min_price'];
		$cond_clause .= " AND sale_price > $min_price";
	} else if (isset($filter['max_price']) && $filter['max_price'] !== "") { // only max
		$max_price = $filter['max_price'];
		$cond_clause .= " AND sale_price < $max_price";
	}

	// sorting logic
	$sort_clause = count($sort) > 0 ? "ORDER BY $sort[0] $sort[1]" : "";

	// pagination logic
	$paginate_clause =  isset($page) ? "LIMIT " . PER_PAGE . " OFFSET " . ($page - 1) * PER_PAGE : "";

	// create query
	$columns_we_want = "title, description, thumbnail, base_price, sale_price, stock, state, discount, created_at";
	$query = "SELECT $columns_we_want FROM products $cond_clause $sort_clause $paginate_clause";

	return [products_count($cond_clause), fetch_query($query)];
}

function products_count($cond)
{
	$query = "SELECT COUNT(*) AS total_num FROM products $cond";
	$records = fetch_query($query);
	return (int) $records[0]['total_num'];
}
