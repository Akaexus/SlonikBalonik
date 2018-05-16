<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Dodawanie</title>
		<style>
			label {
				display: block;
			}
		</style>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Formularz dodania przedmiotu</legend>
				<label>
					Nazwa
					<input type="text" name="name">
				</label>
				<label>
					Ilość
					<input type="text" name="quanity">
				</label>
				<label>
					Edycja
					<select name="edition">
						<?php
						require_once('config.php');
							$c = mysqli_connect($host, $user, $passwd, $db);
							if(mysqli_connect_errno()) {
								echo 'cos sie zepsulo!<br>'.mysqli_connect_error();
							}
							$rslt = $c->query('select * from edition');
							while($row = $rslt->fetch_assoc()) {
								echo "<option value=\"{$row['id_edition']}\">{$row['edition']}</option>";
							}
						?>
					</select>
				</label>
				<label>
					Opis
					<input type="text" name="description">
				</label>
				<input type="submit" value="dodaj" name="submit">
			</fieldset>
		</form>
		<?php
			$forms = [
				'name'=> 1,
				'quanity'=> 1,
				'edition'=> 1,
				'description'=> 0
			];
			if(isset($_POST['submit'])) {
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
				if(isset($formValues['description'])) {
				mysqli_query($c, "insert into product(name, quanity, edition, description) values('{$formValues['name']}', '{$formValues['quanity']}', '{$formValues['edition']}', '{$formValues['description']}')");
				} else {
				mysqli_query($c, "insert into product(name, quanity, edition) values('{$formValues['name']}', '{$formValues['quanity']}', '{$formValues['edition']}')");
				}
			}
		?>
		<a href="dodajedycje.php">A może chcesz dodać edycje?</a>
	</body>
</html>