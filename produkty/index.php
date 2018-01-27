<!DOCTYPE html>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Sklep</title>
		<link rel="stylesheet" href="site.css">
	</head>
	<body>
		<header>
			<h1>Sklep wielobranżowy u Belethora</h1>
		</header>
		<?php
			require('db.php');
			require('products.class.php');
			$shoppingList = new ShoppingList($db);
			$products = $shoppingList->getProducts();
			if(count($products)) {
				echo '<table><tbody><tr>'
				.implode('', array_map(function($e) {
					return "<th>$e</th>";
				}, array_keys($products[0])))
				.'</thead></tbody><tbody>';
				echo implode('', array_map(function($e) {
					return "<td>$e</td>";
				}, $products[0]));

			}
		?>
	</body>
</html>
