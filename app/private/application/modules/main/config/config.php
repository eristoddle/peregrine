<?php

return new \Phalcon\Config([
	'database' => [
		'adapter' => 'Mysql',
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'test',
		'persistent' => true,
		'charset' => 'utf8'
	],

	'controllers' => [
		'annotationRouted' => [
			'\Peregrine\Main\Controllers\API\Index',
		]
	]
]);
