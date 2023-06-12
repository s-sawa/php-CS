<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="icon" href="./favicon/favicon.svg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .ff {
      font-family: 'Hannotate TC', sans-serif;
    }
  </style>
</head>

<body>
  <div>

    <div class="w-full max-w-xs mx-auto flex items-center h-screen  justify-center">
      <form class="bg-lime-200 shadow-md rounded px-8 py-2" name="form1" action="login_act.php" method="post">
        <div class="mb-4">
          <h1 class="ff text-center text-2xl font-bold mt-5  rounded py-1 bg-gradient-to-r from-lime-400 to-green-500">Connect Card</h1>

          <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="username">
            ID
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="lid" placeholder="ID" />
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
          </label>
          <div id="fieldPassword" class="border shadow rounded flex items-center bg-white">
            <input id="textpw" type="password" class="appearance-none  rounded w-5/6 px-3 text-gray-700 my-2 leading-tight focus:outline-none focus:shadow-outline" type="password" name="lpw" placeholder="PASSWORD" />
            <span id="buttonEye" class="fa fa-eye cursor-pointer" onclick="pushHideButton()"></span>
          </div>
          <div class="flex justify-center pt-5">
            <input class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="LOGIN" />
          </div>
        </div>
        <div class="flex justify-center pb-5">
          <button><a href="./user.php" class=" bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline">新規登録</a></button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function pushHideButton() {
      var txtPass = document.getElementById("textpw");
      var btnEye = document.getElementById("buttonEye");

      if (txtPass.type === "text") {
        txtPass.type = "password";
        btnEye.className = "fa fa-eye cursor-pointer";
      } else {
        txtPass.type = "text";
        btnEye.className = "fa fa-eye-slash cursor-pointer";
      }
    }
  </script>
</body>

</html>