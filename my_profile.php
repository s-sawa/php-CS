<?php
session_start();
include "funcs.php";
sschk();
error_reporting(0);


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



//フォロー人数
$sql = 'SELECT COUNT(*) FROM cards_table WHERE read_lid = :read_lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':read_lid', $read_lid, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count_follow = $stmt->fetchcolumn();
} //フォロワー人数
$sql = 'SELECT COUNT(*) FROM cards_table WHERE readed_lid = :readed_lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':readed_lid', $readed_lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count_follower = $stmt->fetchcolumn();
    // $count = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ編集</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>

    <style>
        .ff {
            font-family: 'Hannotate TC', sans-serif;
        }

        .custom-color {
            background-color: <?= $mydata["theme_color"] ?>;
        }
    </style>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>
    <!-- <div class="bg-orange-200"> -->
    <div class="container">
        <div>
            <?php
            if (empty($mydata[0])) {
                echo "プロフィールを登録してね";
            } else { ?>
                <form method="post" action="insert.php" enctype="multipart/form-data">
                    <div class="max-w-sm mx-auto my-10 rounded-xl shadow-md p-5 custom-color">
                        <div class="flex">
                            <div class="">
                                <img class="w-32 h-32 object-cover shadow-lg rounded-full mx-auto " src="<?= $mydata["img_path"] ?>" alt="" width="100px">
                                <span><?= $count_follow ?></span>
                                <span>フォロー</span><br>
                                <span><?= $count_follower ?></span>
                                <span>フォロワー</span>
                                <div class="text-#a0f99a">緑色のテキスト</div>
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
                                <!-- <input type="file"  name="upload_image"><br> -->
                            </div>
                        </div>
                    </div>
                </form>
                <!-- <button onclick="createQR()">QR作成</button> -->
                <div>
                    <!-- <button onclick="createQR('<?= $mydata["id"] ?>')">QRコードを表示する</button> -->
                    <!-- <div id="img-qr" class="p-10"></div> -->
                </div>
                <div class="overlay" id="js-overlay"></div>
                <div class="modal" id="js-modal">

                    <div class="modal-close__wrap">
                        <button class="modal-close" id="js-close">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div id="img-qr" class="p-10"></div>

                    <p>コンテンツ・内容が入ります。</p>
                </div>
                <button class="modal-open" id="js-open" onclick="createQR('<?= $mydata["id"] ?>')">QRコード作成</button>
                <!-- if終了 -->
            <?php } ?>

        </div>



    </div>
    <!-- Main[End] -->
    <script src="./js/select.js"></script>
    <script src="./js/create_QR.js"></script>
    <script>
        //モーダルの表示と非表示
        const modal = $("#js-modal");
        const overlay = $("#js-overlay");
        const close = $("#js-close");
        const open = $("#js-open");

        open.on('click', function() { //ボタンをクリックしたら
            modal.addClass("open"); // modalクラスにopenクラス付与
            overlay.addClass("open"); // overlayクラスにopenクラス付与
        });
        close.on('click', function() { //×ボタンをクリックしたら
            modal.removeClass("open"); // overlayクラスからopenクラスを外す
            overlay.removeClass("open"); // overlayクラスからopenクラスを外す
        });
    </script>

</body>

</html>