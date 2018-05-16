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
				<legend>Formularz dodania edycji</legend>
				<label>
					Nazwa
					<input type="text" name="name">
				</label>
				<input type="submit" value="dodaj" name="submit">
			</fieldset>
		</form>
		<?php
			$forms = [
				'name'=> 1,
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
				require_once('config.php');
				$c = mysqli_connect($host, $user, $passwd, $db);
				if(mysqli_connect_errno()) {
					echo 'cos sie zepsulo!<br>'.mysqli_connect_error();
				}
				$c->query('insert into edition(edition) values(\''.$formValues['name'].'\')');
			}
		?>
	</body>
</html>