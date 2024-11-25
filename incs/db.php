<?php

$db_config = [
    'host' => 'MySQL-8.2',
    'user' => 'root',
    'pass' => '',
    'db' => 'auth',
];

$dsn = "mysql:host={$db_config['host']};dbname={$db_config['db']};charset=utf8mb4";     //unicode - высокая лексическая точность, ci - case insensitive (nAmE)
$opt = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Отображение ошибок в php8 по умолчанию
];

$db = new PDO($dsn, $db_config['user'], $db_config['pass'], $opt);



