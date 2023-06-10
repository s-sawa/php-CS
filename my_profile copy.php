<?php
session_start();
include "funcs.php";
sschk();
// error_reporting(0);

$id = $_GET["id"];
$read_lid = $_SESSION["lid"];
$readed_lid = $_SESSION["lid"];
// $name =  $_SESSION["name"];
// echo $id;
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
$sql = "SELECT * FROM users_info WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //:idに$idを渡す
$status = $stmt->execute();
$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $mydata = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイカード</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script></script>

    <style>
        .ff {
            font-family: 'Hannotate TC', sans-serif;
        }
    </style>
</head>

<body class="">
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div class="container bg-lime-100 h-screen flex justify-center mx-auto ">
        <div>
            <?php if (empty($mydata[0])) { ?>
                <p>まだプロフィールが登録されていません。</p>
                <div class="bg-lime-300 text-center py-5"><a href="input.php">プロフィールを入力する</a></div>
            <?php } else { ?>
                <form method="post" action="insert.php" enctype="multipart/form-data">
                    <div class="test max-w-[100%] mx-auto my-10 rounded-xl shadow-lg p-5 bg-[<?= $mydata["theme_color"] ?>]">
                        <div class="flex">
                            <div class="">
                                <img class="w-32 h-32 object-cover shadow-lg rounded-full mx-auto " src="<?= $mydata["img_path"] ?>" alt="" width="100px">
                                <?php require_once("./count_follow.php")  ?>
                                <span>フォロー</span><br>
                                <?php require_once("./count_follower.php")  ?>
                                <span>フォロワー</span>
                            </div>
                            <div>
                                <span>私の名前は</span><span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm "><?= $mydata["name"] ?></span> !<br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm "><?= $mydata["nickname"] ?></span><span>って呼んでね！</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $mydata["gender"] ?></span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $mydata["blood_type"] ?>型</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $mydata["birthmonth"] ?>月</span><span>生まれで</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $mydata["comment"] ?></span><br>
                                <div>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $mydata["favo1"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $mydata["favo2"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $mydata["favo3"] ?></span><br>
                                </div>
                                <input type=" text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="overlay" id="js-overlay"></div>
                <div class="modal" id="js-modal">
                    <div class="modal-close__wrap">
                        <button class="modal-close" id="js-close">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div id="img-qr" class="p-10"></div>
                </div>
                <button class="modal-open rounded" id="js-open" onclick="createQR('<?= $mydata["id"] ?>')">QR作成</button>
                <!-- if終了 -->
            <?php } ?>
        </div>
    </div>
    <script src="./js/select.js"></script>
    <script src="./js/create_QR.js"></script>
    <script src="./js/main.js"></script>

</body>

</html>