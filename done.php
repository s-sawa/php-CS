<?php
session_start();
$lid = $_SESSION["lid"];
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
$sql = "SELECT * FROM users_info WHERE lid = :lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();
$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $mydata = $stmt->fetch();
}
echo "<br>";
echo $mydata["id"];
// echo $_SESSION["infoid"];
redirect('my_profile.php?id=' . $mydata["id"]);
// redirect("my_profile.php?=15");
?>
