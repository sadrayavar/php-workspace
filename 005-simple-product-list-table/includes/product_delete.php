<?php

function delete_product($title, $soft_delete = true)
{
	if ($soft_delete) {
		$query = "UPDATE products set state='deleted' where title='$title'";
	} else {
		$query = "DELETE FROM products where title='$title'";
	}

	return fetch_query($query . " AND state<>'deleted'", "delete");
}
