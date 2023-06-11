<?php
$lid = $_SESSION["lid"];
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
$sql = 'SELECT COUNT(*) FROM users_info WHERE lid = :lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
} else {
    $count = $stmt->fetchcolumn();
}
// echo $count;
if ($count == 1) {
    $sql2 = 'SELECT * FROM users_info WHERE lid=:lid';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
    $status2 = $stmt2->execute();
    if ($status2 == false) {
        $error = $stmt2->errorInfo();
        exit("SQLError:" . $error[2]);
    } else {
        $data = $stmt2->fetch();
    }
}

// var_dump($data);
// $json = json_encode($infos, JSON_UNESCAPED_UNICODE);
?>
<nav class="flex justify-between items-center w-[94%] mx-auto py-2">
    <div>
        <img class="w-16" src="./logo/logo.png" alt="">
    </div>
    <div class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[30vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5 z-50">
        <ul class="flex md:flex-row flex-col md:items-center  md:gap-[4vw] gap-4">
            <!-- <?php if (!empty($mydata[0])) { ?> -->
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="my_profile.php">マイカード</a>
                <!-- <a class="hover:text-gray-500 md:text-sm font-bold" href="my_profile.php?id=<?= $data['id']; ?>">マイカード</a> -->
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="u_view.php?id=<?= $data['id']; ?>">カード編集</a>
            </li>
            <!-- <?php } ?> -->
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="profile_list.php">カードリスト</a>
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="getcard.php">フォローする</a>
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="logout.php" onclick="logoutMsg()">ログアウト</a>
            </li>
            <!-- <li>
                <a href="logout.php" onclick="return confirm('本当にログアウトしてもよろしいですか？');">ログアウト</a>
            </li> -->
        </ul>

    </div>
    <div class="flex items-center gap-6">
        <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
    </div>
</nav>
<script>
    const navLinks = document.querySelector('.nav-links')

    function onToggleMenu(e) {
        e.name = e.name === "menu" ? "close" : "menu";
        navLinks.classList.toggle("top-[7%]")
    }

    function logoutMsg() {
        alert("aaa")
    }
</script>