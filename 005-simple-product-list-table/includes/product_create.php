<?php

function create_prdouct($product_data)
{
	// shorter name for main argument
	$pd = &$product_data;

	// simple checking of sql injection
	$numeric_args = [$pd['base_price'], $pd['sale_price'], $pd['stock']];
	$string_args = [$pd['title'], $pd['state'], $pd['description']];
	if (is_sql_injection($numeric_args, $string_args)) die("Try harder!");

	// columns and values for main query
	$columns = "";
	$values = "";

	// add system defined values to main query
	$pd['created_at'] = date("Y-m-d H:i:s", time());
	$pd['updated_at'] = $pd['created_at'];

	// fix for "division by zero" in discouont
	$pd['discount'] = 100;

	// add user defined values to main query
	foreach ($pd as $name => $value) {
		// data clearing
		$value = trim($value);
		if (mb_strlen($value) < 3) return "$name length be at least 3 characters";

		//create column names
		$columns .= "$name, ";

		//create values
		if ($value === "") $value = "NULL";
		else if (!is_numeric($value)) $value = "'$value'";
		$values .= "$value, ";
	}
	$columns = substr($columns, 0, strlen($columns) - 2);
	$values = substr($values, 0, strlen($values) - 2);

	// create main query
	$query = "INSERT INTO products ($columns) VALUES ($values)";

	return fetch_query($query, "insert");
}
