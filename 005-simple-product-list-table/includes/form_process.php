<?php

//define what page we are in now
$uri_last_lart = explode('/', $request_uri)[2];
$on_home_page = ($uri_last_lart === "index.php" || $uri_last_lart === ""); // check if final part is empty (index.php) or not
$on_modify_page = !$on_home_page && isset($_GET['product_title']);
$on_create_page = !$on_home_page && !$on_modify_page;

if ($on_home_page) {

	// delete product from
	if (isset($_GET['delete_product'])) {
		delete_product($_GET['delete_product']);
		redirect("./" . generate_querystring(['delete_product' => null]));
	}

	// sorting logic
	$sort = ["sale_price", "asc"];
	if (isset($_GET['sort'])) {
		$sort = explode("_", $_GET['sort']);
		if ($sort[0] === "sale") $sort[0] = "sale_price";
	}

	// this variable is used in footer and body
	$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

	// receive filter arguments
	$filter = [];
	if (isset($_GET['filter'])) {
		$filter = [
			'title' => $_GET['title'],
			'state' => $_GET['state'],
			'min_price' => $_GET['min_price'],
			'max_price' => $_GET['max_price']
		];
	}
	$read_results = read_products($current_page, $filter, $sort);

	// other values needed for footer
	$total_product_number = $read_results[0];
	$total_pages = ceil($total_product_number / PER_PAGE);
} else {

	// get data and define current result state
	$operation_success = false; // no result
	$error_message = null;  // no result
	if (isset($_GET['operation_result'])) {
		if (is_numeric($_GET['operation_result']) && $_GET['operation_result'] !== 0) {
			$operation_success = true;  // operation completed
		} else {
			$error_message = error_translate($_GET['operation_result']); // the reason why operation failed
		}
	}

	// edit product (GET product-edit.php)
	if (isset($_GET['product_title'])) {
		// fill inputs
		$read_results = read_products(1, filter: ['title' => $_GET['product_title']]);
		if ($read_results[0] === 0) {
			$error_message = "محصول مورد نظر یافت نشد";
		} else if ($read_results[0] > 1) {
			$error_message = "نام محصول تکراری می باشد";
		} else {
			$product_data = $read_results[1][0];
		}
	}

	// create/modify button pushed (POST product-edit.php)
	if (isset($_POST['proceed'])) {

		// save the source and unset it from $_post
		$source = $_POST['source'];
		unset($_POST['source']);

		// remove proceed key from post superglobal
		unset($_POST['proceed']);

		// check if modifying and then remove the key from post superglobal
		$on_modify_page = $_POST['modify_operation'];
		unset($_POST['modify_operation']);

		// new file uploaded
		if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
			// save the new file and get its url
			$_POST['thumbnail'] = upload_image_to_server($_FILES['thumbnail']);

			// delete the previous image if there is one
			if ($_POST['previous_thumbnail']) {
				delete_image_on_server($_POST['previous_thumbnail']);
			}
		}
		unset($_POST['previous_thumbnail']);

		// update/create product
		$operation_result = ($on_modify_page) ? update_product($_POST) : create_prdouct($_POST);

		// delete the saved image if operation failed
		if ($operation_result !== true && isset($_POST['thumbnail'])) {
			delete_image_on_server($_POST['thumbnail']);
		}
		// return the results
		if ($operation_result) {
			$data_to_pass = [
				"operation_result" => $operation_result,
				"source" => $source
			];

			if ($on_modify_page) {
				$data_to_pass["product_title"] = $_POST[($operation_result === true) ? 'title' : 'previous_title'];
			}

			redirect("./product-edit.php" . generate_querystring($data_to_pass));
		}
	}
}
