<!DOCTYPE html>

<head>
    <title>QRコードのテスト</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./favicon/favicon.svg">


</head>

<body>
    <div id="wrapper">
        <video id="video" autoplay muted playsinline class=""></video>
        <canvas id="camera-canvas"></canvas>
        <canvas id="rect-canvas"></canvas>
        <span id="qr-msg">QRコード: 見つかりません</span>
    </div>
    <a href="http://www.google.co.jp/" onclick="check('外部のページへ移動します。よろしいですか？')">リンクをクリックして下さい。</a>

    <script src="./js/jsQR.js"></script>
    <script src="./js/script.js"></script>
    <script>
        // function test(msg) {
        //     alert(msg);
        // }
        function check(msg) {
            ret = confirm(`${msg}のページに移動しますか？`)
            if (ret) {
                location.href = msg;
            }
        }
    </script>
</body>

</html>