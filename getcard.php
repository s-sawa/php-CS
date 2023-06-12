<?php
session_start();
include "funcs.php";
sschk();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR読み取り</title>
    <link rel="icon" href="./favicon/favicon.svg">
    <link rel="stylesheet" href="./css/qr.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="icon" href="./favicon/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js/main.js"></script>
</head>

<body class="bg-neutral-50 h-screen">
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div id="wrapper">
        <video id="video" autoplay muted playsinline class=""></video>
        <canvas id="camera-canvas"></canvas>
        <canvas id="rect-canvas"></canvas>
        <span id="qr-msg">QRコード: 見つかりません</span>
    </div>
    <!-- スマホ用 -->
    <input id="upload" type="file" name="image" accept="image/*">
    <!-- ログアウト確認モーダル -->
    <?php include("logout_modal.php") ?>

    <script src="./js/jsQR.js"></script>
    <script src="./js/script.js"></script>
    <script>
        function check(msg) {
            ret = confirm("登録しますか？")
            // ret = confirm(`${msg}のページに移動しますか？`)
            if (ret) {
                location.href = msg;
            }
        }
    </script>
</body>

</html>