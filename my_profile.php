<?php
session_start();
require_once 'funcs.php';
sschk();
// error_reporting(0);

$id = $_GET["id"];
// $read_lid = $_SESSION["lid"];
// $readed_lid = $_SESSION["lid"];
// $name =  $_SESSION["name"];
// echo $id;
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
    <link rel="icon" href="./favicon/favicon.svg">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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
    <div class="container bg-neutral-50 justify-center mx-auto pb-20 min-h-[100vh]  relative">
        <!-- <div> -->
        <?php if (empty($mydata[0])) { ?>
            <div class="text-center">
                <p class="mt-4 mb-10 text-lg pt-2">プロフィールが登録されていません</p>
                <a href="input.php" class=" bg-emerald-600 hover:bg-emerald-800 text-white font-bold p-5  rounded-full focus:outline-none focus:shadow-outline">プロフィールを登録する</a>
            </div>
        <?php } else { ?>
            <div class="box-border flex mx-auto justify-center max-w-lg">
                <div class="">
                    <div class="">
                        <div class="w-[95%] sm:w-[70%] md:w-[80%]  my-2 bg-white shadow-lg transform duration-200 easy-in-out mx-auto bg-[<?= $mydata["theme_color"] ?>] ">
                            <div class=" h-32 overflow-hidden">
                                <img class="w-full" src="./images/gs1.png" alt="" />
                                <!-- <img class="w-full" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" /> -->
                            </div>
                            <div class="flex justify-center px-5  -mt-12">
                                <img class="h-32 w-32 object-cover bg-white p-2 rounded-full mb-2 " src="<?= $mydata["img_path"] ?>" alt="" />
                            </div>
                            <div class=" ">
                                <div class="text-center px-2">
                                    <span class="text-sm inline-block ">ニックネーム</span><br>
                                    <span class="ff inline-block font-bold text-3xl bg-slate-50 px-2 rounded text-gray-700 mb-2"><?= h($mydata["nickname"]) ?></span><br>
                                    <span class="ff inline-block font-bold bg-slate-50 px-2 rounded text-gray-700 mb-2"><?= $mydata["birthmonth"] ?>月</span><span>生まれの</span><span class="ff font-bold bg-slate-50 px-2 rounded-sm text-gray-700"><?= $mydata["zodiac"] ?></span><br>
                                    <span>血液型は</span><span class="ff inline-block font-bold bg-slate-50 px-2 rounded mb-2 text-gray-700"><?= $mydata["blood_type"] ?>型</span><span>だよ</span><br>
                                    <span>属性</span><span class="ff inline-block font-bold bg-slate-50 px-2 rounded mb-2 text-gray-700"><?= $mydata["type"] ?></span><span></span><br>
                                    <p class="text-sm">私の趣味 / 好きなこと</p>
                                    <div class="">
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= h($mydata["favo1"]) ?></span><br>
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= h($mydata["favo2"]) ?></span><br>
                                        <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= h($mydata["favo3"]) ?></span><br>
                                    </div>
                                    <p class="text-sm inline-block mt-2">ひとこと</p><br>
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= h($mydata["comment"]) ?></span><br>
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
            <!-- QR表示用モーダル -->
            <div class="overlay" id="js-overlay"></div>
            <div class="modal" id="js-modal">
                <div class="modal-close__wrap">
                    <button class="modal-close" id="js-close">
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div id="img-qr" class="p-2  bg-neutral-100 text-center"></div>
            </div>
            <!-- フォローしてもらうボタン -->
            <div class="w-full flex justify-center">
                <button class="modal-open bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3" id="js-open" onclick='createQR(<?= $mydata["id"] ?>)'>フォローしてもらう</button>
            </div>
            <div class="w-full flex justify-center">
                <a href="test.php?id=<?= $mydata["lid"] ?>" class=" bg-red-600 hover:bg-emerald-800 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3 absolute bottom-0 left-auto" onclick="deleteMsg('<?= $mydata["id"] ?>')">削除</a>
            </div>
            <!-- ログアウトメッセージ用モーダル -->
            <!-- if終了 -->
        <?php } ?>
    </div>
    <footer class="bg-gray-100">
        <?php include("footer.php") ?>
    </footer>
    <script src="./js/select.js"></script>
    <script src="./js/create_QR.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>