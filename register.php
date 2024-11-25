<?php

session_start();
require_once __DIR__ . '/incs/config.php'; //констната ROOT недоступна без config
require_once ROOT . '/incs/db.php';
require_once ROOT . '/incs/functions.php';

//var_dump($db);


$title = 'Register';

require_once VIEWS . '/register.tpl.php';

