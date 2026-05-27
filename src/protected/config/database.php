<?php

$dbHost = $_ENV['MYSQL_HOST'] ? $_ENV['MYSQL_HOST'] : 'mysql';
$dbName = $_ENV['MYSQL_DATABASE'] ? $_ENV['MYSQL_DATABASE'] : 'book_catalog';
$user = $_ENV['MYSQL_USER'] ? $_ENV['MYSQL_USER'] : 'user';
$password = $_ENV['MYSQL_PASSWORD'] ? $_ENV['MYSQL_PASSWORD'] : 'user';

return [
	'connectionString' => "mysql:host=$dbHost;dbname=$dbName",
	'emulatePrepare' => true,
	'username' => $user,
	'password' => $password,
	'charset' => 'utf8mb4',
];