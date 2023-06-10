<?php
session_start();
include "funcs.php";
sschk();
?>
<!DOCTYPE html>

<head>
    <title>QR読みとり</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./favicon/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>

<body>
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div id="wrapper">
        <video id="video" autoplay muted playsinline class=""></video>
        <canvas id="camera-canvas"></canvas>
        <canvas id="rect-canvas"></canvas>
        <span id="qr-msg">QRコード: 見つかりません</span>
    </div>
    <a href="http://www.google.co.jp/" onclick="check('外部のページへ移動します。よろしいですか？')">リンクをクリックして下さい。</a>

    <script src="./js/jsQR.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/main.js"></script>
    <script>
        function check(msg) {
            ret = confirm(`${msg}のページに移動しますか？`)
            if (ret) {
                location.href = msg;
            }
        }
    </script>
</body>

</html>