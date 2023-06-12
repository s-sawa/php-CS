<?php
session_start();
include "funcs.php";
sschk();
?>
<?php
$id = $_GET["id"];
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
    <title>プロフィール編集</title>
    <link rel="icon" href="./favicon/favicon.svg">
    <link rel="stylesheet" href="./css/modal.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
    </style>
</head>

<body>
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div>
        <form method="post" action="update.php" enctype="multipart/form-data">
            <div class="min-h-[100vh]">
                <form method="post" action="insert.php" enctype="multipart/form-data">
                    <div class="max-w-sm mx-auto my-10  rounded shadow-md p-5 bg-lime-200">
                        <fieldset>
                            <label class="block mb-2 texr-gray-900"><input type="text" name="nickname" required placeholder="ニックネーム" value="<?= $mydata["nickname"] ?>" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
                            <span>誕生月</span>
                            <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 pr-4 " name="birthmonth" id="month">
                                    <!-- <label class="block mb-2 texr-gray-900"><select name="birthmonth" id="month"> -->
                                    <option value="1" <?php if ($mydata["birthmonth"] == 1) {
                                                            echo "selected";
                                                        } ?>>1月</option>
                                    <option value="2" <?php if ($mydata["birthmonth"] == 2) {
                                                            echo "selected";
                                                        } ?>>2月</option>
                                    <option value="3" <?php if ($mydata["birthmonth"] == 3) {
                                                            echo "selected";
                                                        } ?>>3月</option>
                                    <option value="4" <?php if ($mydata["birthmonth"] == 4) {
                                                            echo "selected";
                                                        } ?>>4月</option>
                                    <option value="5" <?php if ($mydata["birthmonth"] == 5) {
                                                            echo "selected";
                                                        } ?>>5月</option>
                                    <option value="6" <?php if ($mydata["birthmonth"] == 6) {
                                                            echo "selected";
                                                        } ?>>6月</option>
                                    <option value="7" <?php if ($mydata["birthmonth"] == 7) {
                                                            echo "selected";
                                                        } ?>>7月</option>
                                    <option value="8" <?php if ($mydata["birthmonth"] == 8) {
                                                            echo "selected";
                                                        } ?>>8月</option>
                                    <option value="9" <?php if ($mydata["birthmonth"] == 9) {
                                                            echo "selected";
                                                        } ?>>9月</option>
                                    <option value="10" <?php if ($mydata["birthmonth"] == 10) {
                                                            echo "selected";
                                                        } ?>>10月</option>
                                    <option value="11" <?php if ($mydata["birthmonth"] == 11) {
                                                            echo "selected";
                                                        } ?>>11月</option>
                                    <option value="12" <?php if ($mydata["birthmonth"] == 12) {
                                                            echo "selected";
                                                        } ?>>12月</option>
                                </select></label><br>
                            <span>星座</span>
                            <label class="inline-block mb-2 texr-gray-900"><select class="ml-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 " name="zodiac" id="zodiac">
                                    <!-- <label class="block mb-2 texr-gray-900"><select name="zodiac" id="zodiac"> -->
                                    <option value="山羊座" <?php if ($mydata["zodiac"] == "山羊座") {
                                                            echo "selected";
                                                        } ?>>山羊座</option>
                                    <option value="水瓶座" <?php if ($mydata["zodiac"] == "水瓶座") {
                                                            echo "selected";
                                                        } ?>>水瓶座</option>
                                    <option value="魚座" <?php if ($mydata["zodiac"] == "魚座") {
                                                            echo "selected";
                                                        } ?>>魚座</option>
                                    <option value="牡羊座" <?php if ($mydata["zodiac"] == "牡羊座") {
                                                            echo "selected";
                                                        } ?>>牡羊座</option>
                                    <option value="牡牛座" <?php if ($mydata["zodiac"] == "牡牛座") {
                                                            echo "selected";
                                                        } ?>>牡牛座</option>
                                    <option value="双子座" <?php if ($mydata["zodiac"] == "双子座") {
                                                            echo "selected";
                                                        } ?>>双子座</option>
                                    <option value="蟹座" <?php if ($mydata["zodiac"] == "蟹座") {
                                                            echo "selected";
                                                        } ?>>蟹座</option>
                                    <option value="獅子座" <?php if ($mydata["zodiac"] == "獅子座") {
                                                            echo "selected";
                                                        } ?>>獅子座</option>
                                    <option value="乙女座" <?php if ($mydata["zodiac"] == "乙女座") {
                                                            echo "selected";
                                                        } ?>>乙女座</option>
                                    <option value="天秤座" <?php if ($mydata["zodiac"] == "天秤座") {
                                                            echo "selected";
                                                        } ?>>天秤座</option>
                                    <option value="蠍座" <?php if ($mydata["zodiac"] == "蠍座") {
                                                            echo "selected";
                                                        } ?>>蠍座</option>
                                    <option value="射手座" <?php if ($mydata["zodiac"] == "射手座") {
                                                            echo "selected";
                                                        } ?>>射手座</option>
                                </select></label><br>
                            <span>血液型</span>
                            <!-- <label class="block mb-2 texr-gray-900"><select name="blood_type" id="blood-type"> -->
                            <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 pr-4" name="blood_type" id="blood-type">
                                    <option value="A" <?php if ($mydata["blood_type"] == "A") {
                                                            echo "selected";
                                                        } ?>>A型</option>
                                    <option value="B" <?php if ($mydata["blood_type"] == "B") {
                                                            echo "selected";
                                                        } ?>>B型</option>
                                    <option value="O" <?php if ($mydata["blood_type"] == "O") {
                                                            echo "selected";
                                                        } ?>>A型</option>
                                    <option value="AB" <?php if ($mydata["blood_type"] == "AB") {
                                                            echo "selected";
                                                        } ?>>AB型</option>
                                </select></label><br>
                            <span>どちらかといえば...</span>
                            <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5" name="type" id="type">
                                    <!-- <label class="block mb-2 texr-gray-900"><select name="type" id="type"> -->
                                    <option value="ボケ" <?php if ($mydata["type"] == "ボケ") {
                                                            echo "selected";
                                                        } ?>>ボケ</option>
                                    <option value="ツッコミ" <?php if ($mydata["type"] == "ツッコミ") {
                                                                echo "selected";
                                                            } ?>>ツッコミ</option>
                                    <option value="ボケツッコミ両方いけるよ" <?php if ($mydata["type"] == "ボケツッコミ両方いけるよ") {
                                                                        echo "selected";
                                                                    } ?>>ボケツッコミ両方いけるよ</option>
                                    <option value="ボケかツッコミか分からない" <?php if ($mydata["type"] == "ボケかツッコミか分からない") {
                                                                        echo "selected";
                                                                    } ?>>ボケかツッコミか分からない</option>
                                </select></label>
                            <p>趣味 / 好きなこと3選</p>
                            <label class="block mb-2 texr-gray-900"><input type="text" name="favo1" required placeholder="ラーメン" value="<?= $mydata["favo1"] ?>" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
                            <label class="block mb-2 texr-gray-900"><input type="text" name="favo2" required placeholder="カレーライス" value="<?= $mydata["favo2"] ?>" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
                            <label class="block mb-2 texr-gray-900"><input type="text" name="favo3" required placeholder="山登り" value="<?= $mydata["favo3"] ?>" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
                            <p>ひとことメッセージ</p>
                            <label class="block mb-2 texr-gray-900"><input type="text" name="comment" required placeholder="Lalavelさいこー。" value="<?= $mydata["comment"] ?>" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
                            <div class="flex items-center mb-2">
                                <span>カードテーマ色</span>
                                <input id="color" type="color" value="<?= $mydata["theme_color"] ?>" name="theme_color" class="cursor-pointer w-[30%] h-10" />
                            </div>
                            <p>プロフィール画像（後からでもOK)</p>
                            <p class="cms-thumb"><img class="shadow w-32 h-32 object-cover rounded-full mx-auto my-2" src="./images/thumbnail.png" width="200"></p>
                            <!-- <input type="file" name="upload_image" multiple><br> -->
                            <input type="file" name="upload_image" multiple class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:bg-violet-50 file:text-gray-700
                            hover:file:bg-violet-100">
                            <input type="text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
                            <!-- <input type="submit" value="送信" class="bg-slate-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3"> -->
                            <div class="flex justify-center">
                                <input type="submit" value="送信" class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3">
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </form>
        <!-- ログアウト確認モーダル -->
        <?php include("logout_modal.php") ?>
    </div>
    <footer class="bg-gray-100">
        <?php include("footer.php") ?>
    </footer>
    <script>
        //---------------------------------------------------
        //画像サムネイル表示
        //---------------------------------------------------
        // アップロードするファイルを選択
        $('input[type=file]').change(function() {
            //選択したファイルを取得し、file変数に格納
            var file = $(this).prop('files')[0];
            // 画像以外は処理を停止
            if (!file.type.match('image.*')) {
                // クリア
                $(this).val(''); //選択されてるファイルを空にする
                $('.cms-thumb > img').html(''); //画像表示箇所を空にする
                return;
            }
            // 画像表示
            var reader = new FileReader(); //1
            reader.onload = function() { //2
                $('.cms-thumb > img').attr('src', reader.result);
            }
            reader.readAsDataURL(file); //3
        });
    </script>

</body>

</html>