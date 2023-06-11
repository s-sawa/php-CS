<?php
session_start();
$cardid = $_GET["id"];
echo "読みとったカードのID";
echo "<br>";
echo $cardid; //QRで読み取ったカードのID
echo "<br>";
echo "loginID" . "<br>";
echo $_SESSION["lid"];
$myid = $_SESSION["lid"];

include "funcs.php";
sschk();

$lid = $_SESSION["lid"];
?>
<?php
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
$sql = 'SELECT * FROM users_info WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $cardid, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $row = $stmt->fetch();
    $read_lid = $_SESSION["lid"]; //誰が読み取るか
    $readed_lid = $row["lid"]; //誰のを読み取るか
    $sql2 = "INSERT INTO cards_table(read_lid,readed_lid)VALUES(:read_lid, :readed_lid);";
    $stmt2 = $pdo->prepare($sql2);;
    $stmt2->bindValue(':read_lid', $read_lid, PDO::PARAM_STR);
    $stmt2->bindValue(':readed_lid', $readed_lid, PDO::PARAM_STR);
    $status = $stmt2->execute();
    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("SQL INSERT Error:" . $error[2]);
    }
}

//1レコードだけ取得する方法

// echo $row["lid"];
// echo $row["nickname"];
// echo "<br>";
// echo $read_lid;
// echo "<br>";
// echo $readed_lid;


// if ($myid == $row["lid"]) {
//     echo "自分のカード,登録するボタン表示させない";
// } else {
//     echo "自分のカードではない、登録するボタン表示する。おしたらそのカードの何らかの情報をDBに記録し、一覧表示できるようにする";
// }
$_SESSION["register"] = $status;

redirect("done.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<div>
    <?php if ($status == 1 ) {?>
        <p>aaaa</p>
    <?php } ?>
    
    <p id="test" class="hidden">登録完了</p>
    <!-- <a href="./mypage.php">戻る</a> -->
    <a href="done.php">戻る</a>
    
</div>

<body>
    <script>
        if (<?php $status ?> == 1) {
            // alert("登録できたよ");
            document.getElementById("test").classList.remove("hidden");

        }
    </script>
</body>

</html>