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