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
$json = json_encode($infos, JSON_UNESCAPED_UNICODE);;
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
        .test {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* 表示したい行の数 */
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-slate-400">
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div class="box-border flex mx-auto justify-center">
        <div class="bg-gray-200 w-[90%]">
            <?php if (count($infos) == 0) { ?>
                <p>まだ誰のカードも登録されてないよ</p>
            <?php } ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($infos as $info) : ?>
                    <div class="max-w-[500px] m-5 my-10 bg-[<?= $info["theme_color"] ?>] rounded-xl shadow-md p-5">
                        <!-- <div class="max-w-sm m-5 my-10 bg-pink-200 rounded-xl shadow-md p-5"> -->
                        <div class="flex">
                            <div class="">
                                <img class="w-32 h-32 object-cover shadow-lg rounded-full mx-auto " src="<?= $info["img_path"] ?>" alt="" width="100px">
                            </div>
                            <div>
                                <span>私の名前は</span><span class="hannotate font-bold bg-slate-50 pr-2 pl-2 rounded-sm "><?= $info["name"] ?></span> !<br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm "><?= $info["nickname"] ?></span><span>って呼んでね！</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $info["gender"] ?></span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $info["blood_type"] ?>型</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $info["birthmonth"] ?>月</span><span>生まれで</span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $info["zodiac"] ?></span><span></span><br>
                                <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm"><?= $info["comment"] ?></span><br>
                                <div>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $info["favo1"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $info["favo2"] ?></span><br>
                                    <span class="ff font-bold bg-slate-50 pr-2 pl-2 rounded-sm">#<?= $info["favo3"] ?></span><br>
                                </div>
                                <input type=" text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
                                <!-- <input type="file"  name="upload_image"><br> -->
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