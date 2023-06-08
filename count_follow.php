<?php
// session_start();
$read_lid = $_SESSION["lid"];
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
// $sql = 'SELECT * FROM users_info WHERE lid=:lid';
$sql = 'SELECT COUNT(*) FROM cards_table WHERE read_lid = :read_lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':read_lid', $read_lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count = $stmt->fetchcolumn();
    // $count = $stmt->fetch();
}
echo $count;