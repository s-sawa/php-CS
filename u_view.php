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
    <title>データ編集</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header class="bg-white">
        <?php include('header.php'); ?>
    </header>
    <div class="bg-orange-200">
        <form method="post" action="insert.php" enctype="multipart/form-data">
            <!-- <div class> -->
            <div class="max-w-sm mx-auto my-10 bg-white rounded-xl shadow-md p-5">
                <fieldset>
                    <!-- <label class="block mb-2 text-lg texr-gray-900"><input type="text" name="name" required placeholder="名前" class="border w-full"></label> -->
                    <label class="block mb-2 text-lg texr-gray-900"><input type="text" name="nickname" required placeholder="ニックネーム" class="border" value="<?= $mydata["nickname"] ?>"></label>
                    <label class="block mb-2 text-lg texr-gray-900"><select name="gender">
                            <option value="">性別</option>
                            <?= $mydata["gender"] ?>;
                            <option value="男性" <?php if ($mydata["gender"] == "男性") echo "selected" ?>>男性</option>
                            <option value="女性" <?php if ($mydata["gender"] == "女性") echo "selected" ?>>女性</option>
                        </select></label>
                    <label class="block mb-2 text-lg texr-gray-900"><select name="birthmonth" id="month">
                            <option value="">何月生まれ</option>
                        </select></label>
                    <label class="block mb-2 text-lg texr-gray-900"><select name="blood_type" id="blood-type">
                            <option value="">血液型</option>
                        </select></label>
                    <label>一言コメント<textArea name="comment" rows="2" cols="30" required placeholder="CSS苦手だ！"></textArea></label><br>
                    <input type="text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
                    <!-- <input type="file"  name="upload_image"><br> -->
                    <input type="submit" value="送信">
                </fieldset>
            </div>
        </form>
    </div>
    <!-- Main[End] -->
    <script src="./js/select.js"></script>

</body>

</html>