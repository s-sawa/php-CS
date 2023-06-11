<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>jqueryのajax</title>
</head>

<body>
  <form id="form1">
    <p>名前</p>
    <input type="text" name="name1" value="鈴木" maxlength="10" />
    <p>ローマ字</p>
    <input type="text" name="romaji1" value="suzuki" maxlength="10" />
    <input type="button" id="button1" value="送信ボタン" />
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(function() {
      $("#button1").click(function() {
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: $("#form1").serialize(),
            dataType: "json",
            timespan: 1000,
          })
          .done(function(data1, textStatus, jqXHR) {
            console.log(jqXHR.status); // 200
            console.log(textStatus); // success
            console.log(data1["m1"]); // 登録しました
            console.log(data1["key1"]); // 鈴木 さん
            console.log(data1["key2"]); // suzuki san
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.status); //例：404
            console.log(textStatus); //例：error
            console.log(errorThrown); //例：NOT FOUND
          })
          .always(function() {
            console.log("complete"); // complete
          });
      });
    });
  </script>
</body>

</html>