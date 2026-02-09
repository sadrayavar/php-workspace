<?php include "partials/header.php"; ?>

<div class="message error">
    نام محصول تکراری می باشد
</div>
<div class="message success">
    ویرایش محصول با موفقیت انجام شد
</div>
<form action="" id="product-register">
    <div class="form-right">
        <div class="form-group">
            <label for="title">نام محصول</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="نام محصول">
        </div>
        <div class="form-group">
            <label for="description">توضیحات</label>
            <textarea rows="15" name="description" id="description" class="form-control" placeholder="توضیحات محصول"></textarea>
        </div>
    </div>
    <div class="form-side">
        <div class="form-group">
            <label for="thumbnail">تصویر شاخص محصول</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png">
        </div>
        <img src="https://dkstatics-public.digikala.com/digikala-products/e89295ab7e1e907808099079ac4ee49a67c771c0_1704658598.jpg"
            alt="" class="thumbnail-preview">
        <div class="form-group">
            <label for="price">قیمت</label>
            <input type="number" name="price" id="price" class="form-control" value="0" step="1">
        </div>
        <div class="form-group">
            <label for="sale_price">قیمت فروش</label>
            <input type="number" name="sale_price" id="sale_price" class="form-control" min="0" step="1" value="0">
        </div>
        <div class="form-group">
            <label for="stock">موجودی انبار</label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" step="1">
        </div>
        <div class="form-group">
            <label for="status">وضعیت</label>
            <select name="status" id="status" class="form-control">
                <option value="publish">انتشار و فروش</option>
                <option value="draft">پیش نویس</option>
                <option value="presale">پیشفروش</option>
            </select>
        </div>
        <button class="btn btn-primary w-100">
            ثبت محصول/ذخیره تغییرات
        </button>
    </div>
</form>

<?php include "partials/footer.php"; ?>
