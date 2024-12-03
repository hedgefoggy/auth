<?php

function dump($data) //: void
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function dd($data) //: never // dump and die
{
//    echo '<pre>' . print_r($data, true) . '</pre>';
    dump($data);
    die;
}

function load(array $fillable, $post = 1)    // $fillable - заполняемый, 1 - true
{
    $load_data = $post ? $_POST : $_GET;
    $data = [];
    foreach ($fillable as $value) {
        if (isset($load_data[$value])) {
            $data[$value] = trim($load_data[$value]);
        } else {
            $data[$value] = '';
        }
    }
    return $data;
}

function check_required_fields(array $data) //: true|array
{
    $errors = [];
    foreach ($data as $k => $v) {
        if (empty($v)) {
            $errors[] = "Не заполнено поле {$k}";
        }
    }
    if (!$errors) {
        return true;
    }
    return $errors;
}

// Helpers
function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES);
}

function old(string $name, $post = true): string // оставляет поля заполненными
{
    $load_data = $post ? $_POST : $_GET;
    return isset($load_data[$name]) ? h($load_data[$name]) : '';
}

function get_errors(array $errors): string
{
    $html = '<ul class="list-unstyled">';
    foreach ($errors as $error) {
        $html .= "<li>{$error}</li>";
    }
    $html .= '<ul>';
    return $html;
}

function get_alerts()//: void
{
    if (!empty($_SESSION['errors'])) {
        require VIEWS . '/incs/alert_danger.tpl.php';
        unset($_SESSION['errors']);
    }
    if (!empty($_SESSION['success'])) {
        require VIEWS . '/incs/alert_success.tpl.php';
        unset($_SESSION['success']);
    }
}

function register(array $data): bool
{
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ? /* ? */"); //проверка email
    $stmt->execute([
        $data['email'],
        //$data['name'] второй ?
    ]);
    //если email уже есть - выдаем ошибку, завершаем функцию
    if ($stmt->fetchColumn()) {
        $_SESSION['errors'] = 'This email is already taken';
        return false;
    }
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (/*?, ?, ?*/:name, :email, :password)");
    $stmt->execute($data); //уже массив
    $_SESSION['success'] = "You have successfully registered";
    return true;
}