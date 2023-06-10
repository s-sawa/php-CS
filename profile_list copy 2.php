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
        <div class="bg-gray-200 ">
            <?php if (count($infos) == 0) { ?>
                <p>まだ誰のカードも登録されてないよ</p>
            <?php } ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 ">
                <?php foreach ($infos as $info) : ?>
                    <div class="w-[95%] sm:w-[70%] md:w-[80%]  my-2 bg-white shadow-lg transform duration-200 easy-in-out mx-auto bg-[<?= $info["theme_color"]?>] ">
                        <!-- <div class="sm:w-full  my-2 bg-white  shadow-lg  transform   duration-200 easy-in-out"> -->
                        <div class=" h-32 overflow-hidden">
                            <img class="w-full" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />
                        </div>
                        <div class="flex justify-center px-5  -mt-12">
                            <img class="h-32 w-32 bg-white p-2 rounded-full   " src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />

                        </div>
                        <div class=" ">
                            <div class="text-center px-14">
                                <h2 class="text-gray-800 text-3xl font-bold"><?= $info["nickname"] ?></h2>
                                <a class="text-gray-400 mt-2 hover:text-blue-500" href="https://www.instagram.com/immohitdhiman/" target="BLANK()">@immohitdhiman</a>
                                <p class="mt-2 text-gray-500 text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            </div>
                            <hr class="mt-6" />
                            <div class="flex  bg-gray-50 ">
                                <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                    <p><span class="font-semibold">2.5 k </span> Followers</p>
                                </div>
                                <div class="border"></div>
                                <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                    <p> <span class="font-semibold">2.0 k </span> Following</p>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="h-screen bg-gray-200  dark:bg-gray-800   flex flex-wrap items-center  justify-center  ">
        <div class="container lg:w-2/6 xl:w-2/7 sm:w-full md:w-2/3    bg-white  shadow-lg    transform   duration-200 easy-in-out">
            <div class=" h-32 overflow-hidden">
                <img class="w-full" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />
            </div>
            <div class="flex justify-center px-5  -mt-12">
                <img class="h-32 w-32 object-cover bg-white p-2 rounded-full   " src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="" />

            </div>
            <div class=" ">
                <div class="text-center px-14">
                    <h2 class="text-gray-800 text-3xl font-bold">Mohit Dhiman</h2>
                    <a class="text-gray-400 mt-2 hover:text-blue-500" href="https://www.instagram.com/immohitdhiman/" target="BLANK()">@immohitdhiman</a>
                    <p class="mt-2 text-gray-500 text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                </div>
                <hr class="mt-6" />
                <div class="flex  bg-gray-50 ">
                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                        <p><span class="font-semibold">2.5 k </span> Followers</p>
                    </div>
                    <div class="border"></div>
                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                        <p> <span class="font-semibold">2.0 k </span> Following</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>