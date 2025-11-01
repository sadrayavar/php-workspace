<?php
$calculated = 0;
if (isset($_GET['price'])) {
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Offer Calculator</title>
</head>

<body>
	<form action="" method="get">
		<p>
			<label for="price">The main price is: </label>
			<input type="number" id="price" name='price' value="<?php echo $_GET['price'] ?? 0 ?>">
		</p>
		<p>
			<label for="offer">Offer is: </label>
			<input type="number" id="offer" name="offer" value="<?php echo $_GET['offer'] ?? 0 ?>">
			%
		</p>
		<p>
			<label for="unit">Unit is: </label>
			<select name="unit" id="unit">
				<option value="dollar">$ (Dollar)</option>
				<option value="euro"
					<?php echo isset($_GET['unit']) && $_GET['unit'] === 'euro' ? "selected" : '' ?>>€ (Euro)
				</option>
			</select>
		</p>

		<input type="submit" value="Calculate">
		<!-- <button>Calculate</button> -->
	</form>

	<div>
		<p>
			Main price is:
			<?php echo $_GET['price'] ?? 0 ?>
		</p>
		<p>
			Offer is:
			<?php echo $_GET['offer'] ?? 0 ?>
		</p>
		<p>
			Price after offer is:
			<?php echo $_GET['calculated'] ?? 0 ?>
		</p>
	</div>
</body>

</html>