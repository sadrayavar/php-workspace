<?php

function update_product($product_data)
{
	// shorter name for main argument
	$pd = &$product_data;

	// simple checking of sql injection
	$numeric_args = [$pd['base_price'], $pd['sale_price'], $pd['stock']];
	$string_args = [$pd['previous_title'], $pd['title'], $pd['description'], $pd['state']];
	if (is_sql_injection($numeric_args, $string_args)) die("Try harder!");

	// create condition clause
	$previous_title = $pd['previous_title'];
	$cond_clause = "WHERE state<>'deleted' AND title='$previous_title'";
	unset($pd['previous_title']);

	// create data clause
	$data_clause = "";

	// add system defined values
	$pd['updated_at'] = date("Y-m-d H:i:s", time());

	// add user defined values
	foreach ($pd as $name => $value) {
		//create values
		if ($value === "") $value = "NULL";
		else if (!is_numeric($value)) $value = "'$value'";
		$data_clause .= "$name=$value, ";
	}
	$data_clause = substr($data_clause, 0, strlen($data_clause) - 2);


	// create and fetch query
	$query = "UPDATE products SET $data_clause $cond_clause ";
	return fetch_query($query, "update");
}
