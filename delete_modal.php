<!-- 削除確認モーダル -->
<div class="modal-delete-container">
    <div class="modal-delete-body w-auto">
        <!-- 閉じるボタン -->
        <div class="modal-delete-close">×</div>
        <!-- モーダル内のコンテンツ -->
        <div class="modal-delete-content rounded bg-red-50 w-auto">
            <!-- <p class="msg text-sm text-center mb-2">ログアウトしますか？</p> -->
            <div class="text-center">
                <i class="fa fa-exclamation-circle fa-5x text-red-400"></i>
            </div>
            <div class="flex flex-col">
                <a id="delete-profile" href="delete_profile.php?id=<?= $mydata["lid"] ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3 text-center">プロフィール削除</a>
                <a id="delete-account" href="delete_account.php?id=<?= $mydata["lid"] ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3 text-center">アカウント削除</a>
                <p class="inline bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4  rounded focus:outline-none focus:shadow-outline mt-3 text-center">キャンセル</p>
                <!-- <p class="bg-slate-300 cursor-pointer" onclick='ajaxDelete("<?= $mydata["lid"] ?>")'>ajaxテスト</p> -->
            </div>
        </div>
    </div>
</div>
<script>
    //ajax練習
    // function ajaxDelete(id) {
    //     // console.log(id)
    //     $.ajax({
    //             type: "POST",
    //             url: "delete_profile2.php",
    //             data: {
    //                 "id": id
    //             },
    //             dataType: "json"
    //         })
    //         .done(function(data) {
    //             data = JSON.parse(data);
    //             console.log(data)
    //         })
    // }
</script>