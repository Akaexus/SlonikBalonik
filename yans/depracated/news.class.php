<?php

class News {
	function __construct($c = false) {
		$this->c = $c;
		if(!$this->c) {
			echo 'nie';
		} else {
			echo 'tak';
		}
	}
	function fetch($id = 0) {
		$stmt = null;
		if(ctype_digit($id)) {
			$query = 'SELECT * FROM `news` WHERE id=?';
			$stmt = $this->c->prepare($query);
			$stmt->bind_param($id);
		} else if(is_array($id)) {
			$query = 'SELECT * FROM `news` WHERE id IN (?)';
			$stmt = $this->c->prepare($query);
			$stmt->bind_param(implode(',', $id);
		} else {
			$query = 'SELECT * FROM `news`';
			$stmt = $this->c->prepare($query);
		}
		$stmt->execute();
		$stmt->store_result();
	}
}