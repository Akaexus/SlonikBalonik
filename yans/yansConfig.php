<?php

$__CONFIG = [
	'title'=> 'To będzie tytuł',
	'db' => [
		'host'=> '127.0.0.1',
		'user'=> 'root',
		'passwd'=> '1234',
		'db'=> 'yans',
		'charset'=> 'utf8'
	],
	'modules'=> [
		['app'=>'/', 'class'=>'main'],
		['app'=>'register', 'class'=>'register'],
		['app'=>'news', 'class'=>'news'],
	]
];
