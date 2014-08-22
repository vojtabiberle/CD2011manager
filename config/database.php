<?php
class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'cdmanager',
		'password' => 'cdmanager',
		'database' => 'cdmanager',
		'encoding' => 'utf8'
	);

        var $test = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'cdmanager-test',
		'password' => 'cdmanager-test',
		'database' => 'cdmanager-test',
		'encoding' => 'utf8'
	);
}
?>