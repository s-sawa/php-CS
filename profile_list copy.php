<?php
session_start();
require_once 'funcs.php';
$lid =  $_SESSION["lid"];
echo $lid;
/** @var PDO $pdo */
$pdo = db_conn();
$sql = 'SELECT * FROM users_info WHERE lid = :lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}
$infos =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
$json = json_encode($infos, JSON_UNESCAPED_UNICODE);
// var_dump($infos);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <style>
        .test {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* 表示したい行の数 */
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="bg-gray-100">
        <div class="flex flex-col md:flex-row flex-wrap">

            <?php foreach ($infos as $info) : ?>
                <div class="max-w-sm mx-auto my-10 bg-white rounded-xl shadow-md p-5">
                    <img class="w-32 h-32 rounded-full mx-auto" src="https://picsum.photos/200" alt="Profile picture">
                    <hr>
                    <h2 class="text-center text-2xl font-semibold mt-3 "><?= $info["nickname"] ?></h2>
                    <p class="text-center text-gray-600 mt-1"><?= $info["comment"] ?></p>
                    <div class="flex justify-center mt-5">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">#お寿司</a>
                        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">#お酒</a>
                        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">#旅行</a>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-xl font-semibold">自己紹介</h3>
                        <p class="text-gray-600 mt-2 test"></p>
                        <a href="./profile_detail.php?id= <?= $info["id"] ?>" class="flex justify-center bg-slate-300">MORE</a>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>

    </div>
</body>




</html>