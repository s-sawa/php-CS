<?php
session_start();
include "funcs.php";
sschk();
// error_reporting(0);

$id = $_GET["id"];
// $read_lid = $_SESSION["lid"];
// $readed_lid = $_SESSION["lid"];
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
    <div class="container bg-lime-100 justify-center mx-auto ">
        <!-- <div> -->
        <?php if (empty($mydata[0])) { ?>
            <!-- echo "プロフィール登録してね"; -->
            <p>まだプロフィールが登録されていません。</p>
            <div class="bg-lime-300 text-center py-5"><a href="input.php">プロフィールを入力する</a></div>
        <?php } else { ?>
            <!-- <form method="post" action="insert.php" enctype="multipart/form-data"></form> -->
            <div class="box-border flex mx-auto justify-center">
                <div class="bg-gray-200 ">
                    <div class="">
                        <div class="w-[95%] sm:w-[70%] md:w-[80%]  my-2 bg-white shadow-lg transform duration-200 easy-in-out mx-auto bg-[<?= $mydata["theme_color"] ?>] ">
                            <!-- <div class="sm:w-full  my-2 bg-white  shadow-lg  transform   duration-200 easy-in-out"> -->
                            <div class=" h-32 overflow-hidden">
                                <img class="w-full" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />
                            </div>
                            <div class="flex justify-center px-5  -mt-12">
                                <img class="h-32 w-32 bg-white p-2 rounded-full " src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />
                            </div>
                            <div class=" ">
                                <div class="text-center px-2">
                                    <span class="text-sm inline-block mt-2 ">ニックネーム</span><br>
                                    <span class="ff inline-block font-bold text-3xl bg-slate-50 px-2 rounded text-gray-700 mb-2"><?= $mydata["nickname"] ?></span><br>
                                    <!-- <a class="text-gray-400 mt-2 hover:text-blue-500" href="https://www.instagram.com/immohitdhiman/" target="BLANK()">@immohitdhiman</a> -->
                                    <!-- <p class="mt-2 text-gray-700 text-sm ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p> -->
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= $mydata["birthmonth"] ?>月</span><span>生まれの</span><span class="ff font-bold bg-slate-50 px-2 rounded-sm text-gray-700"><?= $mydata["zodiac"] ?></span><br>
                                    <span>血液型は</span><span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= $mydata["blood_type"] ?>型</span><span>だよ</span><br>
                                    <span>属性</span><span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= $mydata["type"] ?></span><span></span><br>
                                    <p class="text-sm mt-2">私の趣味 / 好きなこと</p>
                                    <div class="">
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $mydata["favo1"] ?></span><br>
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $mydata["favo2"] ?></span><br>
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $mydata["favo3"] ?></span><br>
                                    </div>

                                    <p class="text-sm inline-block mt-2">ひとこと</p><br>
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= $mydata["comment"] ?></span><br>
                                </div>
                                <hr class="mt-6" />
                                <div class="flex  bg-gray-50 ">
                                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                        <p><span class="font-semibold"><?php include("./count_follow.php") ?></span> フォロー</p>
                                    </div>
                                    <div class="border"></div>
                                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                        <p> <span class="font-semibold"><?php include("./count_follower.php") ?></span> フォロワー</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            </div>
            <button class="modal-open rounded" id="js-open" onclick="createQR('<?= $mydata["id"] ?>')">フォローしてもらう</button>
            <!-- if終了 -->
        <?php } ?>
        <!-- </div> -->
    </div>
    <script src="./js/select.js"></script>
    <script src="./js/create_QR.js"></script>
    <script src="./js/main.js"></script>

</body>

</html>