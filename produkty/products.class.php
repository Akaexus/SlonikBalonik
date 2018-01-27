<?php

class ShoppingList {
	private $c;
	public $productProperties;
	function __construct($db) {

		$this->productProperties = [
			'name'=> [
				'test'=>[function($string) {
					return strlen($string<=255);
				}],
				'parse'=>[]
			],
			'quantity'=> [
				'test'=>[],
				'parse'=>[]
			],
			'price'=> [
				'test'=>[],
				'parse'=>[]
			],
			'done'=>[
				'test'=>[],
				'parse'=>[]
			]
		];

		$this->c = new mysqli($db['host'], $db['user'], $db['password'], $db['db']);
		if(mysqli_connect_errno()) {
			throw 'Coś się zepsuło!';
		}
		$this->c->set_charset('utf8');
	}

	public function getProducts($id = null) {
		$query = $this->c->query('SELECT * FROM products'.(is_numeric($id)?' WHERE id=\''.$id.'\'':''));
		if($query) {
			$products = [];
			while($row = $query->fetch_assoc()) {
				array_push($products, $row);
			}
			return $products;
		}
	}

	public function add($product) {
		$validatedProperties = [];
		foreach ($this->productProperties as $name => $tests) {
			if(array_key_exists($name, $product)) {
				foreach ($tests['test'] as $test) {
					if(!$test($product[$name])) {
						return null;
					}
				}
				foreach($tests['parse'] as $parse) {
					$product[$name] = $parse($product[$name]);
				}
				$validatedProperties[$name] = $product[$name];
			}
		}
		if($this->c->query('SELECT * FROM products WHERE name=\''.$validatedProperties['name'].'\'')->fetch_assoc()['name']) {
			$this->c->query('UPDATE products SET quantity=quantity+'.$validatedProperties['quantity'].' WHERE name=\''.$validatedProperties['name'].'\'');
		} else {
			$this->c->query('INSERT INTO products('.implode(',', array_map(function($e){return "`$e`";}, array_keys($product))).') VALUES('.implode(',', array_map(function($e){return "'$e'";}, array_values($product))).');');
		}
	}

	public function setState($id) {
		if(is_numeric($id)) {
			$this->c->query('UPDATE products SET done = not done WHERE id='.$id);
		}
	}

	public function delete($id) {
		if(is_numeric($id)) {
			$this->c->query('DELETE FROM products WHERE id='.$id);
		}
	}

	function __destruct() {
		$this->c->close();
	}
}