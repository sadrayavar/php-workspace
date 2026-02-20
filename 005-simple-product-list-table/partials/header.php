<?php include "includes/init.php" ?>
<!DOCTYPE html>
<html lang="fa">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if ($on_home_page): ?>
		<title>لیست محصولات</title>
	<?php else: ?>
		<title><?php echo $on_modify_page ? "ویرایش" : "ثبت" ?> محصول</title>
	<?php endif; ?>

	<link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="box-container">
		<header>
			<div class="title">
				<?php if ($on_home_page): ?>
					<h1>لیست محصولات</h1>
				<?php else: ?>
					<h1><?php echo $on_modify_page ? "ویرایش" : "ثبت" ?> محصول</h1>
					<p>از این بخش میتوانید محصول <?php echo $on_modify_page ? "مدنظر را ویرایش" : "جدید ثبت" ?> کنید</p>
				<?php endif; ?>
			</div>

			<div class="table-button">
				<?php if ($on_home_page): ?>
					<a href="product-edit.php" class="btn btn-main">
						+ ثبت محصول جدید
					</a>
				<?php else: ?>
					<a href="<?php echo $_GET["source"] ?? $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">
						بازگشت به صفحه مرجع
					</a>
				<?php endif; ?>
			</div>
		</header>