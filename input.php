<?php
session_start();
// $id = $_GET["id"];
include "funcs.php";
sschk();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>プロフィール入力</title>
  <link rel="icon" href="./favicon/favicon.svg">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <style>
  </style>
</head>

<body>
  <div class="min-h-[100vh]">
    <form method="post" action="insert.php" enctype="multipart/form-data">
      <div class="max-w-sm mx-auto my-10  rounded shadow-md p-5 bg-lime-200">
        <fieldset>
          <label class="block mb-2 texr-gray-900"><input type="text" name="nickname" required placeholder="ニックネーム" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
          <span>誕生月</span>
          <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 pr-4 " name="birthmonth" id="month"></select></label><br>
          <span>星座</span>
          <label class="inline-block mb-2 texr-gray-900"><select class="ml-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 " name="zodiac" id="zodiac"></select></label><br>
          <span>血液型</span>
          <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5 pr-4" name="blood_type" id="blood-type"></select></label><br>
          <span>どちらかといえば...</span>
          <label class="inline-block mb-2 texr-gray-900"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5" name="type" id="type"></select></label>
          <p>趣味 / 好きなこと3選</p>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo1" required  class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo2" required  class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo3" required  class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
          <p>ひとことメッセージ</p>
          <label class="block mb-2 texr-gray-900"><input type="text" name="comment" required placeholder="Lalavelさいこー。" class="rounded-lg outline-none border-b-2 p-1 w-5/6"></label>
          <div class="flex items-center mb-2">
            <span>カードテーマ色</span>
            <input type="color" value="#ffffff" name="theme_color" class="cursor-pointer w-[30%] h-10" />
          </div>
          <p>プロフィール画像（後からでもOK)</p>
          <p class="cms-thumb"><img class="shadow w-32 h-32 object-cover rounded-full mx-auto my-2" src="./images/thumbnail.png" width="200"></p>
          <input type="file" name="upload_image" multiple class="block w-full text-sm text-slate-500
          file:mr-4 file:py-2 file:px-4
          file:rounded-lg file:border-0
          file:text-sm file:bg-violet-50 file:text-gray-700
        hover:file:bg-violet-100">
          <input type="text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
          <div class="flex justify-center">
            <input type="submit" value="送信" class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3">
          </div>
        </fieldset>
      </div>
    </form>
  </div>
  <footer class="bg-gray-100">
    <?php include("footer.php") ?>
  </footer>
  <script src="./js/select.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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