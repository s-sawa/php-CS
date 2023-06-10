<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //id
$lpw = $_POST["lpw"]; //password

//1.  DB接続します
include("funcs.php");
// $pdoの型指定  $pdoがPDOという型であることを示す。これを書かないとintelephenseでエラー表示となる。動きには問題ない
/** @var PDO $pdo */
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$sql = "SELECT * FROM users_table WHERE lid=:lid AND life_flg=0"; //passハッシュ化されていてここではイコールできない
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();
$val = $stmt->fetch();

//3. SQL実行時にエラーがある場合STOP
if ($status == false) {
  sql_error($stmt);
} 
else {
  $sql = "SELECT * FROM users_info WHERE lid=:lid";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
  $status = $stmt->execute();
  $val2 = $stmt->fetch();
} 

//4. 抽出データ数を取得
// $val = $stmt->fetch();
$pw = password_verify($lpw, $val["lpw"]); //true or false
if ($pw) {  //trueだったらの意味
  //Login成功時
  //サーバーに以下を預ける
  $_SESSION["chk_ssid"]  = session_id(); //自分のセッションIDを取得する。
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["lid"]       = $val['lid'];
  $_SESSION["infoid"]    = $val2["id"];
  //Login成功時（リダイレクト）
  // redirect("index.php");
  //マイプロフィールカードの画面に遷移させる
  redirect('my_profile.php?id='.$val2["id"]);
  // redirect("mypage.php");
} else {
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect("login.php");
}
exit();
