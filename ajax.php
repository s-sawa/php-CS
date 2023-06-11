<?php
header("Content-type: text/plain; charset=UTF-8");

if (
    isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
) {

    $str1 = $_POST['name1'] . " さん";
    $str2 = $_POST['romaji1'] . " san";

    $message = ['m1' => '登録しました'];

    $message = $message + array('key1' => $str1);
    $message = $message + array('key2' => $str2);

    echo json_encode($message);
}
