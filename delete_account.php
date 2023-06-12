<?php
session_start();
require_once("funcs.php");
sschk();

$lid = $_GET["id"];
echo $lid;

/** @var PDO $pdo */
$pdo = db_conn();
$pdo->beginTransaction();

$sql1 = "DELETE FROM users_info WHERE lid = :lid";
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindValue(':lid', $lid, PDO::PARAM_STR);
$status1 = $stmt1->execute();

$sql2 = "DELETE FROM users_table WHERE lid = :lid";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
$status2 = $stmt2->execute();

$sql3 = "DELETE FROM cards_table WHERE read_lid = :lid";
$stmt3 = $pdo->prepare($sql3);
$stmt3->bindValue(':lid', $lid, PDO::PARAM_STR);
$status3 = $stmt3->execute();

$sql4 = "DELETE FROM cards_table WHERE readed_lid = :lid";
$stmt4 = $pdo->prepare($sql4);
$stmt4->bindValue(':lid', $lid, PDO::PARAM_STR);
$status4 = $stmt4->execute();

$pdo->commit();
redirect("logout.php");