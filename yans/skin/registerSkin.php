<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class registerSkin extends yansSkin {
	function form($errors = array()) {
		$output = '<div class="yansBox">';
		if(count($errors)) {
			$output .= '<ul class="message error">';
			foreach ($errors as $error) {
				$output .= "<li>$error</li>";
			}
			$output .= '</ul>';
		}
		$output .= '
			<div class="yansForm">
				<form method="POST">
					<label>
						Email*:
						<input name="email" type="email">
					</label>
					<label>
						Nazwa użytkownika*:
						<input name="username" type="text">
					</label>
					<label>
						Hasło*:
						<input name="password" type="password">
					</label>
					<label>
						Powtórz hasło*:
						<input name="password2" type="password">
					</label>
					<label>
						Imię:
						<input name="firstname" type="text">
					</label>
					<label>
						Nazwisko:
						<input name="surname" type="text">
					</label>
					<label>
						Miejsce:
						<input name="place" type="text">
					</label>
					<div class="message unspecific">
						Rejestrując się w naszym serwisie akceptujesz naszą <b><a href="#">Politykę prywatności</a></b> oraz <b><a href="#">regulamin</a></b>.
					</div>
					<button class="button button_main" type="submit" name="do" value="register">Zarejestruj</button>
				</form>
			</div>
		</div>';
		return $output;
	}
}
