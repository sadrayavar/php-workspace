<?php include 'main.php'; ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Html in Loops</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="table-container">

            <div class="table-filters mb-4 row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="search">جستجو</label>
                        <input type="search" name="search" class="form-control" id="search">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="status">وضعیت</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">فعال</option>
                            <option value="inactive">غیر فعال</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <br>
                    <button class="btn btn-primary">اعمال فیلتر</button>
                </div>
            </div><!--.table-filters-->

            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">تلفن</th>
                        <th scope="col">
                            <a href="<?php echo generate_querystring("sortOrder", ($sortOrder === "صعودی" ? "نزولی" : "صعودی")) ?>" class="order">
                                سن <?php echo $sortOrder ? "($sortOrder)" : "" ?>
                            </a>
                        </th>
                        <th scope="col">وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($page_users as $index => $user): ?>
                        <tr>
                            <th scope="row"><?php echo (USER_NUM_IN_PAGE * $current_page) + $index + 1 - USER_NUM_IN_PAGE ?></th>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['family'] ?></td>
                            <td><?php echo $user['phone'] ?></td>
                            <td><?php echo $user['age'] ?></td>
                            <td>
                                <span class="badge text-bg-success"><?php echo $user['status'] === "active" ? "فعال" : "غیرفعال" ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav>
                <ul class="pagination">
                    <li class="page-item<?php echo $current_page === 1 ? " disabled" : "" ?>">
                        <a class="page-link" href="<?php echo generate_querystring("page", $current_page - 1) ?>">Previous</a>
                    </li>

                    <?php if ($current_page !== 1): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo generate_querystring("page", $current_page - 1) ?>"><?php echo $current_page - 1 ?></a></li>
                    <?php endif; ?>

                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?php echo $current_page ?></span>
                    </li>

                    <?php if ($current_page !== $last_page): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo generate_querystring("page", $current_page + 1) ?>"><?php echo $current_page + 1 ?></a></li>
                    <?php endif; ?>

                    <li class="page-item<?php echo $current_page === $last_page ? " disabled" : "" ?>">
                        <a class="page-link" href="<?php echo generate_querystring("page", $current_page + 1) ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</body>

</html>