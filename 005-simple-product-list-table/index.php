<?php include "includes/header.php"; ?>
<?php
$current_page = $_GET['page'] ? (int) $_GET['page'] : 1;
$total_product_number = total_product_num();
$total_pages = ceil($total_product_number / PER_PAGE);
?>

<div class="table-filter">
  <div class="filter">
    <label for="search">جستجو</label>
    <input type="search" id="search" name="search" placeholder="جستجو" value="" class="form-control">
  </div>
  <div class="filter">
    <label for="status">وضعیت</label>
    <select name="status" id="status" class="form-control">
      <option value=""> - همه - </option>
      <option value="publish">درحال فروش</option>
      <option value="expire">توقف فروش</option>
      <option value="draft">پیش نویس</option>
      <option value="preslae">پیشفروش</option>
    </select>
  </div>
  <div class="filter filter-price">
    <label for="search">قیمت</label>
    <div>
      از
      <input type="search" name="price_from" placeholder="از" value="" class="form-control">
      تا
      <input type="search" name="price_to" placeholder="تا" value="" class="form-control">
    </div>
  </div>
  <div class="filter btn-filter">
    <button class="btn btn-primary ">
      فیلتر کردن
    </button>
  </div>
</div><!--.table-filter-->

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>
        <a href="#" class="order-desc">
          <svg xmlns="http://www.w3.org/2000/svg" width="17.505" height="18.5" viewBox="0 0 17.505 18.5">
            <g id="arrow-swap" transform="translate(-3.252 -2.75)">
              <path id="Path_15" data-name="Path 15" d="M-943.99-509.75h-.02a.739.739,0,0,1-.511-.219l-5.01-5.01a.755.755,0,0,1,0-1.06.755.755,0,0,1,1.06,0l3.73,3.731V-527.5a.754.754,0,0,1,.75-.75.754.754,0,0,1,.75.75v17a.736.736,0,0,1-.06.292.735.735,0,0,1-.159.238q-.025.023-.052.044a.744.744,0,0,1-.478.175Z" transform="translate(953 531)" fill="#c1c1c1" />
              <path id="Path_14" data-name="Path 14" d="M-949.748-510.5v-17a.755.755,0,0,1,.751-.75.735.735,0,0,1,.146.015.742.742,0,0,1,.393.205l5.01,5.01a.754.754,0,0,1,0,1.059.742.742,0,0,1-.53.22.742.742,0,0,1-.53-.22l-3.74-3.739v15.2a.749.749,0,0,1-.75.75A.756.756,0,0,1-949.748-510.5Z" transform="translate(963.988 531)" fill="#c1c1c1" />
            </g>
          </svg>
          محصول
        </a>
      </th>
      <th>
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="17.505" height="18.5" viewBox="0 0 17.505 18.5">
            <g id="arrow-swap" transform="translate(-3.252 -2.75)">
              <path id="Path_15" data-name="Path 15" d="M-943.99-509.75h-.02a.739.739,0,0,1-.511-.219l-5.01-5.01a.755.755,0,0,1,0-1.06.755.755,0,0,1,1.06,0l3.73,3.731V-527.5a.754.754,0,0,1,.75-.75.754.754,0,0,1,.75.75v17a.736.736,0,0,1-.06.292.735.735,0,0,1-.159.238q-.025.023-.052.044a.744.744,0,0,1-.478.175Z" transform="translate(953 531)" fill="#c1c1c1" />
              <path id="Path_14" data-name="Path 14" d="M-949.748-510.5v-17a.755.755,0,0,1,.751-.75.735.735,0,0,1,.146.015.742.742,0,0,1,.393.205l5.01,5.01a.754.754,0,0,1,0,1.059.742.742,0,0,1-.53.22.742.742,0,0,1-.53-.22l-3.74-3.739v15.2a.749.749,0,0,1-.75.75A.756.756,0,0,1-949.748-510.5Z" transform="translate(963.988 531)" fill="#c1c1c1" />
            </g>
          </svg>
          قیمت
        </a>
      </th>
      <th>
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="17.505" height="18.5" viewBox="0 0 17.505 18.5">
            <g id="arrow-swap" transform="translate(-3.252 -2.75)">
              <path id="Path_15" data-name="Path 15" d="M-943.99-509.75h-.02a.739.739,0,0,1-.511-.219l-5.01-5.01a.755.755,0,0,1,0-1.06.755.755,0,0,1,1.06,0l3.73,3.731V-527.5a.754.754,0,0,1,.75-.75.754.754,0,0,1,.75.75v17a.736.736,0,0,1-.06.292.735.735,0,0,1-.159.238q-.025.023-.052.044a.744.744,0,0,1-.478.175Z" transform="translate(953 531)" fill="#c1c1c1" />
              <path id="Path_14" data-name="Path 14" d="M-949.748-510.5v-17a.755.755,0,0,1,.751-.75.735.735,0,0,1,.146.015.742.742,0,0,1,.393.205l5.01,5.01a.754.754,0,0,1,0,1.059.742.742,0,0,1-.53.22.742.742,0,0,1-.53-.22l-3.74-3.739v15.2a.749.749,0,0,1-.75.75A.756.756,0,0,1-949.748-510.5Z" transform="translate(963.988 531)" fill="#c1c1c1" />
            </g>
          </svg>
          تخفیف
        </a>
      </th>
      <th>موجودی</th>
      <th style="width: 110px;">وضعیت</th>
      <th>تاریخ ثبت</th>
      <th>عملیات</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($products = read_product($current_page, "sale_price", "asc")): ?>
      <?php $index = 0 ?>
      <?php foreach ($products as $product): ?>
        <tr>
          <?php $index++ ?>
          <td><?php echo $index ?></td>
          <td>
            <div class="table-flex-col">
              <img class="product-thumbnail" src="<?php echo $product["thumbnail"] ?>" alt="">
              <p class="product-title"><?php echo $product["title"] ?></p>
            </div>
          </td>
          <td>
            <del><?php echo $product["base_price"] ?></del>
            <ins><?php echo $product["sale_price"] ?></ins>
          </td>
          <td><?php echo $product["discount"] ?></td>
          <td><?php echo $product["stock"] ?></td>
          <td>
            <div class="product-status <?php echo $product["state"] !== "draft" ? $product["state"] : null ?>">
              <?php
              switch ($product["state"]) {
                case 'draft':
                  echo "پیش نویس";
                  break;
                case 'publish':
                  echo "در حال فروش";
                  break;
                case 'pending':
                  echo "پیش فروش";
                  break;
                case 'expire':
                  echo "توقف فروش";
                  break;
              }
              ?>
            </div>
          </td>
          <td><?php echo $product['created_at'] ?></td>
          <td>
            <div class="table-flex-col">
              <a href="#" class="btn-icon edit-product">
                <svg xmlns="http://www.w3.org/2000/svg" width="17.502" height="18.094" viewBox="0 0 17.502 18.094">
                  <g id="edit-2" transform="translate(-3.252 -1.426)">
                    <path id="Path_4" data-name="Path 4" d="M5.54,19.52a2.291,2.291,0,0,1-1.59-.6,2.382,2.382,0,0,1-.68-2.03l.37-3.24a3.605,3.605,0,0,1,.87-1.86L12.72,3.1C14.77.93,16.91.87,19.08,2.92s2.23,4.19.18,6.36l-8.21,8.69a3.605,3.605,0,0,1-1.81.97l-3.22.55C5.85,19.5,5.7,19.52,5.54,19.52ZM15.93,2.91a3.055,3.055,0,0,0-2.12,1.2L5.6,12.81a2.309,2.309,0,0,0-.47,1l-.37,3.24a.879.879,0,0,0,.22.77.9.9,0,0,0,.78.18l3.22-.55a2.234,2.234,0,0,0,.97-.52l8.21-8.69C19.4,6.92,19.85,5.7,18.04,4A3.162,3.162,0,0,0,15.93,2.91Z" fill="#292d32" />
                    <path id="Path_5" data-name="Path 5" d="M17.34,10.95h-.07a6.859,6.859,0,0,1-6.11-5.78.754.754,0,0,1,1.49-.23,5.372,5.372,0,0,0,4.78,4.52.751.751,0,0,1,.67.82A.774.774,0,0,1,17.34,10.95Z" fill="#292d32" />
                  </g>
                </svg>
              </a>
              <a href="#" class="btn-icon delete-product">
                <svg xmlns="http://www.w3.org/2000/svg" width="19.497" height="21.499" viewBox="0 0 19.497 21.499">
                  <g id="trash" transform="translate(-2.247 -1.251)">
                    <path id="Path_11" data-name="Path 11" d="M-910.21-502.25c-3.49,0-3.631-1.93-3.74-3.49l-.65-10.07a.756.756,0,0,1,.7-.8.758.758,0,0,1,.8.7l.65,10.07c.11,1.52.149,2.09,2.24,2.09h6.42c2.1,0,2.14-.57,2.24-2.09l.65-10.07a.763.763,0,0,1,.8-.7.75.75,0,0,1,.7.8l-.65,10.07c-.111,1.561-.25,3.49-3.74,3.49Zm1.539-5.5a.756.756,0,0,1-.75-.75.756.756,0,0,1,.75-.751h3.33a.756.756,0,0,1,.751.751.756.756,0,0,1-.751.75Zm-.83-4a.755.755,0,0,1-.75-.75.756.756,0,0,1,.75-.75h5a.756.756,0,0,1,.75.75.755.755,0,0,1-.75.75Zm-7.25-7.2a.744.744,0,0,1,.67-.82l2.04-.2q1.4-.143,2.807-.218l.213-1.273c.16-.96.381-2.29,2.71-2.29h2.621c2.34,0,2.56,1.38,2.71,2.3l.22,1.3v0c1.607.09,3.218.22,4.829.378a.75.75,0,0,1,.67.82.74.74,0,0,1-.74.68h-.08a78.829,78.829,0,0,0-15.8-.2l-2.039.2c-.026,0-.051,0-.077,0A.752.752,0,0,1-916.75-518.95Zm12.466-1.271-.166-.979c-.139-.87-.17-1.04-1.229-1.04h-2.62c-1.06,0-1.08.14-1.23,1.03l-.17.958q1.1-.034,2.2-.033Q-905.9-520.286-904.284-520.221Z" transform="translate(919 525)" fill="#292d32" />
                  </g>
                </svg>
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="6">
          نتیجه ای یافت نشد
        </td>
      </tr>
    <?php endif; ?>
  </tbody>
</table><!--.table-->

<div class="table-footer">
  <div class="result">
    کل نتایج: <?php echo $total_product_number ?> | صفحه <?php echo $current_page ?> از <?php echo $total_pages ?>
  </div>
  <div class="pagination">
    <a href="#" class="prev">
      <svg xmlns="http://www.w3.org/2000/svg" width="8.597" height="17.337" viewBox="0 0 8.597 17.337">
        <path id="arrow-right-3" d="M16.012,20.67a.742.742,0,0,0,.53-.22.754.754,0,0,0,0-1.06l-6.52-6.52a1.231,1.231,0,0,1,0-1.74l6.52-6.52a.75.75,0,0,0-1.06-1.06l-6.52,6.52a2.724,2.724,0,0,0-.8,1.93,2.683,2.683,0,0,0,.8,1.93l6.52,6.52A.786.786,0,0,0,16.012,20.67Z" transform="translate(-8.162 -3.333)" fill="#292d32" />
      </svg>
    </a>
    <?php

    ?>

    <?php if ($current_page > 1): ?>
      <a href="#">1</a>
    <?php endif; ?>

    <?php if ($current_page > 3): ?>
      <div>...</div>
    <?php endif; ?>

    <?php if ($current_page > 2): ?>
      <a href="#"><?php echo $current_page - 1 ?></a>
    <?php endif; ?>

    <span><?php echo $current_page ?></span>

    <?php if ($current_page < $total_pages): ?>
      <a href="#"><?php echo $current_page + 1 ?></a>
    <?php endif; ?>

    <?php if ($current_page < $total_pages - 2): ?>
      <div>...</div>
    <?php endif; ?>

    <?php if ($current_page < $total_pages - 1): ?>
      <a href="#"><?php echo $total_pages ?></a>
    <?php endif; ?>

    <a href="#" class="next">
      <svg xmlns="http://www.w3.org/2000/svg" width="8.597" height="17.337" viewBox="0 0 8.597 17.337">
        <path id="arrow-right-3" d="M8.91,20.67a.742.742,0,0,1-.53-.22.754.754,0,0,1,0-1.06l6.52-6.52a1.231,1.231,0,0,0,0-1.74L8.38,4.61A.75.75,0,1,1,9.44,3.55l6.52,6.52a2.724,2.724,0,0,1,.8,1.93,2.683,2.683,0,0,1-.8,1.93L9.44,20.45A.786.786,0,0,1,8.91,20.67Z" transform="translate(-8.162 -3.333)" fill="#292d32" />
      </svg>
    </a>
  </div><!--.pagination-->
</div><!--.table-footer-->

<?php include "includes/footer.php"; ?>