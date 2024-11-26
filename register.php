<?php

session_start();
require_once __DIR__ . '/incs/config.php'; //констната ROOT недоступна без config
require_once ROOT . '/incs/db.php';
require_once ROOT . '/incs/functions.php';

//var_dump($db);


$title = 'Register';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // '==' сравнивает только значения 5 == '5'; '===' по типу (в JS);
    $data = load(['name', 'email', 'password']);
    $validate = check_required_fields($data);
    dump($validate);
}


require_once VIEWS . '/register.tpl.php';





