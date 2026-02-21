<?php include "partials/header.php"; ?>

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