<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class registerSkin extends yansSkin {
	function form() {
		return '<form method="POST">
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
		</form>';
	}
}