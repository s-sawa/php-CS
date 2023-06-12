<?php
session_start();
require_once 'funcs.php';
sschk();
// error_reporting(0);
$read_lid =  $_SESSION["lid"];
// $word = $_GET["word"];
$word = $_POST["word"];

/** @var PDO $pdo */
$pdo = db_conn();
$sql = 'SELECT * FROM users_info INNER JOIN cards_table ON cards_table.readed_lid = users_info.lid WHERE read_lid = :read_lid AND (favo1 = :word OR favo2 = :word OR favo3 = :word)';
// // $sql = 'SELECT * FROM users_info INNER JOIN cards_table ON cards_table.readed_lid = users_info.lid WHERE read_lid = :read_lid AND favo1 = :word';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':read_lid', $read_lid, PDO::PARAM_STR);
$stmt->bindValue(':word', $word, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($values, JSON_UNESCAPED_UNICODE);
    echo $json;
}