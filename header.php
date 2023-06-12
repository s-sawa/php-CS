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

?>
<nav class="flex justify-between items-center w-[98%] mx-auto py-2 align-middle ">
    <div>
        <img class="w-16" src="./logo/logo.png" alt="">
    </div>
    <div class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[30vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5 z-50">
        <ul class="flex md:flex-row flex-col md:items-center  md:gap-[4vw] gap-4">
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="my_profile.php?id=<?= $data['id']; ?>">マイカード</a>
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="u_view.php?id=<?= $data['id']; ?>">カード編集</a>
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="profile_list.php">カードリスト</a>
            </li>
            <li>
                <a class="hover:text-gray-500 md:text-sm font-bold" href="getcard.php">フォロー</a>
            </li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="hover:text-gray-500 md:text-sm font-bold md:p-0  flex items-center justify-between w-full md:w-auto">設定 <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="hidden bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow my-4 w-44">
                <ul class="py-1" aria-labelledby="dropdownLargeButton">
                    <li>
                        <span id="delete" href="#" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">削除</span>
                        <!-- <a id="delete" href="#" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">削除</a> -->
                    </li>
                </ul>
            </div>
            <li>
                <a id="logout" class="hover:text-gray-500 md:text-sm font-bold" href="" onclick="checkLogout()">ログアウト</a>
                <!-- <a class="hover:text-gray-500 md:text-sm font-bold" href="logout.php" onclick="checkLogout()">ログアウト</a> -->
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
        navLinks.classList.toggle("top-[85px]")
        // navLinks.classList.toggle("top-[7%]")
    }

    function checkLogout() {}
</script>
<script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>