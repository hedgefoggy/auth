<?php

session_start();
require_once __DIR__ . '/incs/config.php'; //констната ROOT недоступна без config
require_once ROOT . '/incs/db.php';
require_once ROOT . '/incs/functions.php';

$title = 'Home';


require_once VIEWS . '/index.tpl.php';