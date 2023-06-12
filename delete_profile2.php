<!-- ajax練習用 -->
<?php
session_start();
require_once("funcs.php");
sschk();

$lid = $_POST["id"];
echo $lid."a";

// /** @var PDO $pdo */
// $pdo = db_conn();
// $pdo->beginTransaction();

// $sql1 = "DELETE FROM users_info WHERE lid = :lid";
// $stmt1 = $pdo->prepare($sql1);
// $stmt1->bindValue(':lid', $lid, PDO::PARAM_STR);
// $status1 = $stmt1->execute();

// $sql2 = "DELETE FROM cards_table WHERE read_lid = :lid";
// $stmt2 = $pdo->prepare($sql2);
// $stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
// $status2 = $stmt2->execute();

// $sql3 = "DELETE FROM cards_table WHERE readed_lid = :lid";
// $stmt3 = $pdo->prepare($sql3);
// $stmt3->bindValue(':lid', $lid, PDO::PARAM_STR);
// $status3 = $stmt3->execute();

// $pdo->commit();
// redirect("logout.php");