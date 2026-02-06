<?php

function cnn()
{
	global $cnn;
	return $cnn;
}

function read_product($page = null, $sort = null, $sort_dir = null, $id = null)
{
	if ($id !== null) {
		// return single product
		if (is_nan($id)) $is_attack = die("bad bad bad!");
		$query = "SELECT * FROM products WHERE id=$id";
	} else {
		// return all (pagination)
		$is_attack = false;
		if (is_null(array_search($sort, [...ALLOWED_KEYWORDS, null]))) $is_attack = true;
		if (is_null(array_search($sort_dir, ["asc", "desc", null]))) $is_attack = true;
		if (is_nan($page)) $is_attack = true;
		if ($is_attack) die("bad bad bad!");

		$sort_clause = "ORDER BY $sort $sort_dir";
		$paginate_clause = "LIMIT " . PER_PAGE . " OFFSET " . ($page - 1) * PER_PAGE;
		$query = "SELECT * FROM products $sort_clause $paginate_clause";
	}

	$results = @mysqli_query(cnn(), $query);
	if (!$results) return [];
	$records = @mysqli_fetch_all($results, MYSQLI_ASSOC);
	mysqli_free_result($results);
	return $records;
}
