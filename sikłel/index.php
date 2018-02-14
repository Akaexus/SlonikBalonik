<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Dodaj mnie</title>
		<style type="text/css">
			body {
				font-family: Arial;
			}
			table {
				border-collapse: collapse;
			}
			td, th {
				border: 1px solid #323232;
				padding: 5px;
			}

			label {
				display: block;
			}
		</style>
	</head>
	<body>
		<h2>Dodaj</h2>
		<form method="POST">
			<label>
				Nazwa: 
				<input type="text" name="name">
			</label>
			<label>
				Ilość: 
				<input type="number" name="quantity">
			</label><label>
				Cena: 
				<input type="number" name="price">
			</label>
			<button type="submit" name="add">Dodaj</button>
		</form>
		<h2>Preferencje</h2>
		<form method="POST">
			<label>
				Cena minimalna: 
				<input type="number" name="from">
			</label>
			<label>
				Cena maksymalna: 
				<input type="number" name="to">
			</label>
			<label>
				Sortuj po cenie: 
				<input type="checkbox" name="sort">
			</label>
			<button type="submit">Szukaj</button>
		</form>
		<h2>Produkty</h2>
		<?php
			function fetchForms($forms, $g) {
				$formValues = array();
				foreach ($forms as $formName) {
					if(isset($g[$formName]) && !empty($g[$formName])) {
						$formValues[$formName] = stripslashes(htmlentities($g[$formName]));
					} else {
						return false;
					}
				}
				return $formValues;
			}

			require_once('db.php');




			$c = mysqli_connect($db['host'], $db['user'], $db['password'], $db['db']);
			if(mysqli_connect_errno()) {
				echo 'cos sie zepsulo i nie bylo mnie slychac';
			} else {
				if(isset($_POST['add'])) {
					$forms = ['name', 'quantity', 'price'];
					$formValues = fetchForms($forms, $_POST);
					if($formValues) {
						mysqli_query($c, 'insert into products('
							.implode(',', array_keys($formValues))
							.') values('
							.implode(',', array_map(function($e) {return "'$e'";}, array_values($formValues)))
							.');');
					}
				}
				if(isset($_GET['delete'])) {
					if(ctype_digit($_GET['delete'])) {
						mysqli_query($c, 'DELETE FROM products where id="'.$_GET['delete'].'"');
					}
				}
				if(isset($_GET['done'])) {
					if(ctype_digit($_GET['done'])) {
						mysqli_query($c, 'UPDATE products set done = not done where id="'.$_GET['done'].'"');
					}
				}


				$query = mysqli_query($c, 'SELECT * FROM products'
					.(isset($_POST['to'], $_POST['from']) && ctype_digit($_POST['from']) && ctype_digit($_POST['to'])?' WHERE price BETWEEN '.$_POST['from'].' AND '.$_POST['to']:'')
					.(isset($_POST['sort'])?' ORDER BY price':'')
				);
				$data = [];
				while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					array_push($data, $row);
				}
				if(mysqli_num_rows($query)) {
					echo '<table><thead><tr>'
					.implode('', array_map(function($e) {return "<th>$e</th>";}, array_merge(array_keys($data[0]), [''])))
					.'</tr></thead><tbody>';
					foreach($data as $product) {
						$product['zdelete'] = '<a href="?delete='.$product['id'].'">X</a>';
						$product['done'] = '<a href="?done='.$product['id'].'">'.($product['done']?'Zrobione':'Do zrobienia').'</a>';
						echo '<tr>';
						echo implode(array_map(function($cell) {
							return "<td>$cell</td>";
						}, $product));
						echo '</tr>';
					}
					echo '</tbody></table>';
				}
			}
		?>
	</body>
</html>