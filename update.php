<?php
session_start();
$lid = $_SESSION["lid"];
$nickname = $_POST["nickname"];
$birthmonth = $_POST["birthmonth"];
$zodiac = $_POST["zodiac"];
$blood_type = $_POST["blood_type"];
$type = $_POST["type"];
$favo1 = $_POST["favo1"];
$favo2 = $_POST["favo2"];
$favo3 = $_POST["favo3"];
$comment = $_POST["comment"];
$theme_color = $_POST["theme_color"];
// $img_path = $_POST["img_path"];

//画像アップロード処理
if (!empty($_FILES)) {
  $filename = $_FILES["upload_image"]["name"];
  $uploaded_path = 'images/' . $filename;
  $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);
  if ($result) {
    $MSG = 'アップロード成功！ファイル名:' . $filename;
    $img_path = $uploaded_path;
  } else {
    $r = rand(1, 3);
    $uploaded_path = 'images/dummy' . $r . '.jpg';
    // $uploaded_path = 'images/hachiware.jpg';
    $img_path = $uploaded_path;
  }
}

require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();

$sql = 'UPDATE users_info SET nickname=:nickname, birthmonth=:birthmonth, zodiac=:zodiac, blood_type=:blood_type, type=:type, favo1=:favo1, favo2=:favo2 , favo3=:favo3 , comment=:comment, theme_color=:theme_color,  img_path=:img_path WHERE lid=:lid;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':birthmonth', $birthmonth, PDO::PARAM_INT);
$stmt->bindValue(':zodiac', $zodiac, PDO::PARAM_STR);
$stmt->bindValue(':blood_type', $blood_type, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':favo1', $favo1, PDO::PARAM_STR);
$stmt->bindValue(':favo2', $favo2, PDO::PARAM_STR);
$stmt->bindValue(':favo3', $favo3, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':theme_color', $theme_color, PDO::PARAM_STR);
$stmt->bindValue(':img_path', $img_path, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  sql_error($stmt); //関数実行 
} else {
  redirect("done.php");
}
