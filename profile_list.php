<?php
session_start();
require_once 'funcs.php';
$read_lid =  $_SESSION["lid"];
/** @var PDO $pdo */
$pdo = db_conn();
// $sql = 'SELECT * FROM users_info WHERE lid = :lid';
$sql = 'SELECT * FROM users_info INNER JOIN cards_table ON cards_table.readed_lid = users_info.lid WHERE read_lid = :read_lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':read_lid', $read_lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}
$infos =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
$json = json_encode($infos, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Document</title>
    <style>
        .ff {
            font-family: 'Hannotate TC', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-400">
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div class="box-border flex mx-auto justify-center">
        <div class="bg-gray-200 ">
            <?php if (count($infos) == 0) { ?>
                <p>まだ誰のカードも登録されてないよ</p>
            <?php } ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 ">
                <?php foreach ($infos as $info) : ?>
                    <div class="w-[95%] sm:w-[70%] md:w-[80%]  my-2 bg-white shadow-lg transform duration-200 easy-in-out mx-auto bg-[<?= $info["theme_color"] ?>] ">
                        <div class=" h-32 overflow-hidden">
                            <img class="w-full" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />
                        </div>
                        <div class="flex justify-center px-5  -mt-12">
                            <img class="h-32 w-32 object-cover bg-white p-2 rounded-full mb-2 " src="<?= $info["img_path"] ?>" alt="" />
                        </div>
                        <div class=" ">
                            <div class="text-center px-2">
                                <span class="text-sm inline-block ">ニックネーム</span><br>
                                <span class="ff inline-block font-bold text-3xl bg-slate-50 px-2 rounded text-gray-700 mb-2"><?= $info["nickname"] ?></span><br>
                                <span class="ff inline-block font-bold bg-slate-50 px-2 rounded text-gray-700 mb-2"><?= $info["birthmonth"] ?>月</span><span>生まれの</span><span class="ff font-bold bg-slate-50 px-2 rounded-sm text-gray-700"><?= $info["zodiac"] ?></span><br>
                                <span>血液型は</span><span class="ff inline-block font-bold bg-slate-50 px-2 rounded mb-2 text-gray-700"><?= $info["blood_type"] ?>型</span><span>だよ</span><br>
                                <span>属性</span><span class="ff inline-block font-bold bg-slate-50 px-2 rounded mb-2 text-gray-700"><?= $info["type"] ?></span><span></span><br>
                                <p class="text-sm ">私の趣味 / 好きなこと</p>
                                <div class="">
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $info["favo1"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $info["favo2"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700 inline-block mt-1">#<?= $info["favo3"] ?></span><br>
                                </div>
                                <p class="text-sm inline-block mt-2">ひとこと</p><br>
                                <span class="ff font-bold bg-slate-50 px-2 rounded text-gray-700"><?= $info["comment"] ?></span><br>
                            </div>
                            <hr class="mt-6" />
                            <div class="flex  bg-gray-50 ">
                                <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                    <p><span class="font-semibold">
                                            <?php
                                            $_SESSION["list_lid"] = $info["lid"];
                                            // $list_lid = $info["lid"];ƒ
                                            include("count_follow_list.php");
                                            ?>
                                        </span> Followers</p>
                                </div>
                                <div class="border"></div>
                                <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                    <p> <span class="font-semibold">
                                            <?php
                                            $_SESSION["list_lid"] = $info["lid"];
                                            // $list_lid = $info["lid"];
                                            include("count_follower_list.php");
                                            ?>
                                            </span> Following</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>