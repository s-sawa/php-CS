<?php
session_start();
// $id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>データ登録</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <style>
  </style>
</head>

<body>
  <div class="bg-lime-200">
    <form method="post" action="insert.php" enctype="multipart/form-data">
      <div class="max-w-sm mx-auto my-10  rounded shadow-md p-5 bg-white">
        <fieldset>
          <label class="block mb-2 texr-gray-900"><input type="text" name="name" required placeholder="お名前" class="outline-none border-b-2 p-1 w-5/6"></label>
          <label class="block mb-2 texr-gray-900"><input type="text" name="nickname" required placeholder="ニックネーム" class="outline-none border-b-2 p-1 w-5/6"></label>
          <label class="inline-block mb-2 texr-gray-900 border-b"><select name="gender">
              <option value="">性別</option>
              <option value="男性">男性</option>
              <option value="女性">女性</option>
              <option value="その他">その他</option>
            </select></label>
          <label class="block mb-2 texr-gray-900"><select name="birthmonth" id="month">
              <option value="">何月生まれ</option>
            </select></label>
          <label class="block mb-2 texr-gray-900"><select name="zodiac" id="zodiac">
              <option value="">星座</option>
            </select></label>
          <label class="block mb-2 texr-gray-900"><select name="blood_type" id="blood-type">
              <option value="">血液型</option>
            </select></label>
          <p>好きなもの お気に入り 推し</p>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo1" required placeholder="ex)趣味" class="outline-none border-b-2 p-1 w-5/6"></label>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo2" required placeholder="アニメ・漫画" class="outline-none border-b-2 p-1 w-5/6"></label>
          <label class="block mb-2 texr-gray-900"><input type="text" name="favo3" required placeholder="食べ物" class="outline-none border-b-2 p-1 w-5/6"></label>
          <p>一言コメント</p>
          <label class="block mb-2 texr-gray-900"><input type="text" name="comment" required placeholder="Lalavelさいこー。" class="outline-none border-b-2 p-1 w-5/6"></label>
          <div>カードテーマ色</div>
          <input type="color" value="" name="theme_color" />
          <p>プロフィール画像（後からでもOK)</p>
          <p class="cms-thumb"><img class="shadow-lg w-32 h-32 object-cover rounded-full mx-auto" src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200"></p>
          <input type="file" name="upload_image"><br>
          <input type="text" name="lid" hidden value="<?= $_SESSION["lid"] ?>">
          <input type="submit" value="送信" class="bg-slate-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3">
        </fieldset>
      </div>
    </form>
  </div>
  <!-- Main[End] -->
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