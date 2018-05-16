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
					if($r['edition'] == 4) {
						echo 'nie mozesz';
						die();
					}
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
						';	
						$rslt = $c->query('select * from edition');
							while($row = $rslt->fetch_assoc()) {
								echo "<option value=\"{$row['id_edition']}\"".($row['id_edition']==$r['edition']?' selected':'').">{$row['edition']}</option>";
							}
						echo '
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
				if(!mysqli_num_rows($c->query('select id_edition from edition where id_edition=\''.$formValues['edition'].'\''))) {
					echo 'nie kombinuj przy formularzu';
					die();
				}
				$query = 'update product set ';
				$sets = [];
				foreach($formValues as $formName=>$formValue) {
					array_push($sets, "$formName='$formValue'");
				}
				$query.=implode(', ', $sets).' WHERE id_product=\''.$_POST['edit'].'\'';
				$c->query($query);
			}





			$result = $c->query('select id_product, name, quanity, p.edition, e.edition as editionName from product p join edition e on p.edition = e.id_edition');
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
				$sum = 0;
				while($row = $result->fetch_assoc()) {
					echo '<tr>';
					$moddedRow = $row;
					unset($moddedRow['edition']);
					foreach(array_values($moddedRow) as $cell) {
						echo '<td>'.$cell.'</td>';
					}
					if($row['edition']!=4) {
						echo '<td><a href="?edytuj='.$row['id_product'].'">Edytuj</a></td>';
					} else {
						echo '<td></td>';
					}
					echo '<tr>';
					$sum++;
				}
				$editionsResult = $c->query('select id_edition, e.edition, count(*) as c from product p join edition e on p.edition = e.id_edition group by id_edition');
				$editions = [];
				while($rw = $editionsResult->fetch_assoc()) {
					$editions[$rw['id_edition']] = [
						'name'=> $rw['edition'],
						'c' => $rw['c']
					];
				}
				echo '</tbody></table>';
				echo 'Statystyki
				<ul>
					<li>Produktów '.$sum.'</li>';
					foreach($editions as $edition) {
						echo "<li>{$edition['name']} {$edition['c']}</li>";
					}
				echo '</ul>';				
			}
		?>
	</body>
</html>