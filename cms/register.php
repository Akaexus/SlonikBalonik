<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Rejestracja</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php
			function validateForm($fields, $g) {
				$g  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$form = [];
				$errors = [];
				foreach($fields as $fieldName => $options) {
					if(isset($g[$fieldName])) {
						if(($options['required'] && $g[$fieldName]!='') || $g[$fieldName]!='') {
							$fieldValue = $g[$fieldName];
							foreach($options['parse'] as $parseFunction) {
								$fieldValue = $parseFunction($fieldValue);						
							}
							foreach($options['test'] as $testFunction) {
								if(!$testFunction($fieldValue)) {
									array_push($errors, $options['error']);
								}
							}
							if(isset($options['equal'])) {
								foreach($options['equal'] as $equalField) {
									if($g[$fieldName]!=$g[$equalField]) {
										array_push($errors, $options['error']);
									}
								}
							} else {
								$form[$fieldName] = $fieldValue;
							}
						}
					} else {
						array_push($errors, 'Nie podano wszystkich pól!');
					}
				}
				if(count($errors)) {
					$errors['type'] = 'errors';
					return $errors;
				} else {
					$form['type'] = 'form';
					return $form;
				}
			}

			$fieldNames = [
				'email'=> [
					'required'=> true,
					'parse'=> [],
					'test'=> [function($e) {
						return filter_var($e, FILTER_VALIDATE_EMAIL);
					}],
					'unique'=> true,
					'error'=> 'Wystąpił błąd z adresem email!'
				], 'username'=> [
					'required'=> true,
					'parse'=>[],
					'unique'=> true,
					'test'=> [function($e) {
						return strlen($e)>=3;
					}, function($e) {
						return !!preg_match('/^[\w\d]+$/', $e);
					}],
					'error'=> 'Wystąpił błąd z nazwą użytkownika'
				], 'password'=> [
					'required'=> true,
					'parse'=>[function($e) {
						return password_hash($e, PASSWORD_BCRYPT);
					}],
					'test'=> [],
					'error'=> ''
				], 'password2'=> [
					'required'=> true,
					'parse'=>[function($e) {
						return password_hash($e, PASSWORD_BCRYPT);
					}],
					'test'=> [],
					'equal'=>['password'],
					'error'=> 'Hasła nie są takie same!'
				], 'firstname'=> [
					'required'=> false,
					'parse'=> [function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego imienia!'
				], 'surname'=> [
					'required'=>false,
					'parse'=> [function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego nazwiska!'
				], 'place'=> [
					'required'=> false,
					'parse'=>[function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego miejsca!'
				]
			];

			if(isset($_POST['register'])) {
				$forms = validateForm($fieldNames, $_POST);
				if($forms['type']=='form') {
					unset($forms['type']);
					require_once('db.php');
					$c = new mysqli($db['host'], $db['user'], $db['passwd'], $db['db']);
					if(mysqli_connect_errno()) {
						echo 'Połączenie z bazą zdechło';
					}
					

					$unique = [];
					foreach ($fieldNames as $key=>$field) {
						if(isset($field['unique']) && $field['unique']) {
							$unique[$key] = $forms[$key];
						}
					}
					if(count($unique)) {
						$existingUserQuery = 'SELECT * FROM members WHERE '
							.implode(' OR ', array_map(function($e) {
								return "$e=?";
							}, array_keys($unique)));
						$stmt = $c->prepare($existingUserQuery);
						if($stmt) {
							$args = array_values(array_values($unique));
							array_unshift($args, implode(array_map(function(){return 's';}, array_keys($unique))));
							$stmt->bind_param(...$args);
							$stmt->execute();
							$stmt->store_result();
							if($stmt->num_rows()>0) {
								echo 'error juz jest taki user';
							}
						}
					}
					$stmt->reset();
					$stmt = $c->prepare('INSERT INTO members('.implode(', ', array_keys($forms)).') VALUES('.implode(', ', array_map(function(){return '?';}, array_keys($forms))).')');
					if($stmt) {
						$args = array_values($forms);
						array_unshift($args, implode(array_map(function(){return 's';}, array_keys($forms))));
						$stmt->bind_param(...$args);
						$stmt->execute();
					}
				}
			}

		?>
		<form method="POST">
			<label for="">
				Email*: 
				<input name="email" type="email">
			</label>
			<label>
				Username*: 
				<input name="username" type="text">
			</label>
			<label>
				Password*: 
				<input name="password" type="password">
			</label>
			<label>
				Password2*: 
				<input name="password2" type="password">
			</label>
			<label>
				Firstname: 
				<input name="firstname" type="text">
			</label>
			<label>
				Surname: 
				<input name="surname" type="text">
			</label>
			<label>
				Place: 
				<input name="place" type="text">
			</label>
			<input type="submit" name="register">
		</form>
	</body>
</html>