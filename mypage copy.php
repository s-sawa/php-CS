<?php
session_start();
include "funcs.php";
sschk();

$lid = $_SESSION["lid"];
?>
<?php
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
// $sql = 'SELECT * FROM users_info WHERE lid=:lid';
$sql = 'SELECT COUNT(*) FROM users_info WHERE lid = :lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count = $stmt->fetchcolumn();
}
// echo $count;
if ($count == 1) {
    $sql2 = 'SELECT * FROM users_info WHERE lid=:lid';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
    $status2 = $stmt2->execute();
    if ($status2 == false) {
        $error = $stmt2->errorInfo();
        exit("SQLError:" . $error[2]);
    } else {
        $data = $stmt2->fetch();
    }
}
// var_dump($data);
// $json = json_encode($infos, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>TOP</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .box {
            margin: 10px;
            padding: 20px;
            font-size: 18px;
            background-color: cornflowerblue;
            border-radius: 10px;
            width: 150px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class=container>
        <!-- <h2 class="heading-016">Hello! <?= $_SESSION["name"]; ?>さん!</h2> -->
        <?php if ($count == 0) { ?>
            <p>プロフィールが入力されていません</p>
        <?php } ?>
        <?php if ($count == 0) { ?>
            <div class="box box-text"><a href="input.php">プロフィールを入力する</a></div>
        <?php } ?>
        <?php if ($count == 1) { ?>
            <div class="box box-text"><a href="my_profile.php?id=<?= $data['id']; ?>">マイプロフィール</a></div>
            <div class="box box-text"><a href="u_view.php?id=<?= $data['id']; ?>">プロフィールを編集する</a></div>
        <?php } ?>
        <div class="box"><a href="profile_list.php">みんなのカード</a></div>
        <div class="box"><a href="search_input.php">検索</a></div>
        <?php if ($_SESSION["kanri_flg"] == 1) { ?>
            <div class="box"><a href="user.php">ユーザー登録</a></div>
            <div class="box"><a href="user_list.php">ユーザー一覧</a></div>
        <?php } ?>
        <div class="box"><a href="logout.php">ログアウト</a></div>
        <div class="box"><a href="getcard.php">みんなのカード登録</a></div>

    </div>
    <!-- <div><a href=""></a></div> -->
</body>

</html>