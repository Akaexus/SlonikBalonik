<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Staty</title>
		<style>
			table {
				border-collapse: collapse;
			}
			td, th {
				padding: 5px;
				border: 1px solid #323232;
			}
			label {
				display: block;
			}
		</style>
	</head>
	<body>
		<?php
			$forms = [
				'name'=> 1,
				'quanity'=> 1,
				'edition'=> 1,
				'description'=> 0
			];
			require_once('config.php');
			$c = mysqli_connect($host, $user, $passwd, $db);
			if(mysqli_connect_errno()) {
				echo 'cos sie zepsulo!<br>'.mysqli_connect_error();
			}
			if(isset($_GET['edytuj']) && ctype_digit($_GET['edytuj'])) {
				$result = $c->query('select id_product, name, quanity, edition, description from product where id_product = \''.$_GET['edytuj'].'\'');
				if(mysqli_num_rows($result)) {
					$r = $result->fetch_assoc();
					echo '		<form method="post" action="?edit">
			<fieldset>
				<legend>Formularz edycji przedmiotu</legend>
				<label>
					Nazwa
					<input type="text" name="name" value="'.$r['name'].'">
				</label>
				<label>
					Ilość
					<input type="text" name="quanity" value="'.$r['quanity'].'">
				</label>
				<label>
					Edycja
					<select name="edition">
						<option value="1"'.($r['edition']==1?' selected':'').'>Edycja standardowa</option>
						<option value="4"'.($r['edition']=='4'?' selected':'').'>Edycja limitowana</option>
					</select>
				</label>
				<label>
					Opis
					<input type="text" name="description" value="'.$r['description'].'">
				</label>
				<button type="submit" name="edit" value="'.$r['id_product'].'">Edytuj</button>
			</fieldset>
		</form>';
				} else {
					echo 'chyba cos ci sie pomylilo, nie ma takiego produktu';
				}
			}




			$forms = [
				'name'=> 1,
				'quanity'=> 1,
				'edition'=> 1,
				'description'=> 0
			];
			if(isset($_POST['edit'])) {
				$formValues = [];
				foreach($forms as $formName=>$formValue) {
					if($forms[$formName]) {
						if(isset($_POST[$formName]) && !empty($_POST[$formName])) {
							$formValues[$formName] = $_POST[$formName];
						} else {
							echo 'Uzupełnij wszystkie pola!';
							die();
						}
					} else {
						if(isset($_POST[$formName]) && !empty($_POST[$formName])) {
							$formValues[$formName] = $_POST[$formName];
						}
					}
				}
				$query = 'update product set ';
				$sets = [];
				foreach($formValues as $formName=>$formValue) {
					array_push($sets, "$formName='$formValue'");
				}
				$query.=implode(', ', $sets).' WHERE id_product=\''.$_POST['edit'].'\'';
				$c->query($query);
			}





			$result = $c->query('select id_product, name, quanity, edition from product');
			$editions = [];
			if(mysqli_num_rows($result)) {
				echo '<table>
						<thead>
							<tr>
								<th>id</th>
								<th>Nazwa</th>
								<th>Ilość</th>
								<th>Edycja</th>
								<th>Opcje</th>
							</tr>
						</thead>
					<tbody>
				';
				while($row = $result->fetch_assoc()) {
					echo '<tr>';
					foreach(array_values($row) as $cell) {
						echo '<td>'.$cell.'</td>';
					}
					echo '<td><a href="?edytuj='.$row['id_product'].'">Edytuj</a></td>';
					echo '<tr>';
					if(!isset($editions[$row['edition']])) {
						$editions[$row['edition']] = 0;
					}
					$editions[$row['edition']]+=1;
				}
				echo '</tbody></table>';
				$sum = 0;
				foreach($editions as $edition) {
					$sum+=$edition;
				}
				echo 'Statystyki
				<ul>
					<li>Produktów '.$sum.'</li>'.
					'<li>Edycja standardowa '.$editions[1].'</li>'.
					'<li>Edycja limitowana '.$editions[4].'</li>'.
					'</ul>';
				
			}
		?>
	</body>
</html>