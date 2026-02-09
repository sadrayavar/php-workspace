<?php include "includes/init.php" ?>
<!DOCTYPE html>
<html lang="fa">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if ($on_home_page): ?>
		<title>لیست محصولات</title>
	<?php else: ?>
		<title>ثبت/ویرایش محصول</title>
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
					<h1>ثبت/ویرایش محصول</h1>
					<p>از این بخش میتوانید محصولات فعلی را ویرایش یا محصول جدید ثبت کنید</p>
				<?php endif; ?>
			</div>

			<?php if ($on_home_page): ?>
				<div class="table-button">
					<a href="#" class="btn btn-secondary">
						+ ثبت محصول جدید
					</a>
				</div>
			<?php endif; ?>
		</header>