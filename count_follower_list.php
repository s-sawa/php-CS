<?php
// echo $list_lid;
// session_start();
$readed_lid = $_SESSION["list_lid"];;
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
// $sql = 'SELECT * FROM users_info WHERE lid=:lid';
$sql = 'SELECT COUNT(*) FROM cards_table WHERE readed_lid = :readed_lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':readed_lid', $readed_lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count = $stmt->fetchcolumn();
    // $count = $stmt->fetch();
}
echo $count;