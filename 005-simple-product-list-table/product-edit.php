<?php include "partials/header.php"; ?>

<?php
// get data and define current result state in this page
$operation_success = false; // no result
$error_message = null;  // no result
if (isset($_GET['operation_result'])) {
    if (is_numeric($_GET['operation_result']) && $_GET['operation_result'] !== 0) {
        $operation_success = true;  // operation completed
    } else {
        $error_message = error_translate($_GET['operation_result']); // the reason why operation failed
    }
}

// edit product (GET this page request)
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

// create/modify button pushed (form POST request)
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
    if ($_FILES['thumbnail']['name']) {
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
?>

<!-- error message -->
<?php if ($error_message): ?>
    <div class="message error"><?php echo $error_message ?></div>
<?php endif; ?>

<!-- success message -->
<?php if ($operation_success): ?>
    <div class="message success"><?php echo $on_modify_page ? 'ویرایش' : 'ثبت' ?> محصول با موفقیت انجام شد</div>
<?php endif; ?>

<form action="./product-edit.php" id="product-register" method="post" enctype="multipart/form-data">

    <input type="hidden" name="modify_operation" value="<?php echo $on_modify_page ?>">

    <?php if ($on_modify_page): ?>
        <input type="hidden" name="previous_title" value="<?php echo $_GET['product_title'] ?>">
    <?php endif; ?>
    <input type="hidden" name="previous_thumbnail" value="<?php echo isset($product_data['thumbnail']) ? $product_data['thumbnail'] : "" ?>">
    <input type="hidden" name="source" value="<?php echo $_SERVER["HTTP_REFERER"] ?>">

    <div class="form-right">
        <div class="form-group">
            <label for="title">نام محصول</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="نام محصول" value="<?php echo ($on_modify_page) ? $product_data['title'] : "" ?>">
        </div>
        <div class="form-group">
            <label for="description">توضیحات</label>
            <textarea rows="15" name="description" id="description" class="form-control" placeholder="توضیحات محصول"><?php echo ($on_modify_page) ? $product_data['description'] : "" ?></textarea>
        </div>
    </div>
    <div class="form-side">
        <div class="form-group">
            <label for="thumbnail">تصویر شاخص محصول</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png" value="<?php echo ($on_modify_page) ? $product_data['thumbnail'] : "" ?>">
        </div>
        <img src="<?php echo ($on_modify_page) ? $product_data['thumbnail'] : "" ?>" alt="" class="thumbnail-preview" />
        <div class="form-group">
            <label for="base_price">قیمت</label>
            <input type="number" name="base_price" id="base_price" class="form-control" min="0" step="0.0001" max="9999999999999999.9999" value="<?php echo ($on_modify_page) ? $product_data['base_price'] : "0" ?>">
        </div>
        <div class="form-group">
            <label for="sale_price">قیمت فروش</label>
            <input type="number" name="sale_price" id="sale_price" class="form-control" min="0" step="0.0001" max="9999999999999999.9999" value="<?php echo ($on_modify_page) ? ($product_data['sale_price']) : "0" ?>">
        </div>
        <div class="form-group">
            <label for="stock">موجودی انبار</label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" step="1" max="65535" value="<?php echo ($on_modify_page) ? $product_data['stock'] : "0" ?>">
        </div>
        <div class="form-group">
            <label for="state">وضعیت</label>
            <select name="state" id="state" class="form-control">
                <option value="publish" <?php echo ($on_modify_page && $product_data['state'] === "publish") ? 'selected' : "" ?>>در حال فروش</option>
                <option value="draft" <?php echo ($on_modify_page && $product_data['state'] === "draft") ? 'selected' : "" ?>>پیش نویس</option>
                <option value="pending" <?php echo ($on_modify_page && $product_data['state'] === "pending") ? 'selected' : "" ?>>پیشفروش</option>
                <option value="expire" <?php echo ($on_modify_page && $product_data['state'] === "expire") ? 'selected' : "" ?>>توقف فروش</option>
            </select>
        </div>
        <button type="submit" name="proceed" class="btn btn-primary w-100">
            <?php echo $on_modify_page ? 'ذخیره تغییرات' : 'ثبت محصول' ?>
        </button>
    </div>
</form>

<?php include "partials/footer.php"; ?>