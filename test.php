<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $val = $_POST['val'];

    // データ処理などの適切な処理を行う
    $result = '処理結果: ' . $val;

    // 結果をJSON形式で返す
    echo json_encode($result);
}
