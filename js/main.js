const navLinks = document.querySelector('.nav-links')
function onToggleMenu(e) {
    e.name = e.name === "menu" ? "close" : "menu";
    navLinks.classList.toggle("top-[12%]")
}


//モーダルの表示と非表示
const modal = $("#js-modal");
const overlay = $("#js-overlay");
const close = $("#js-close");
const open = $("#js-open");

open.on('click', function() { //ボタンをクリックしたら
    modal.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
});
close.on('click', function() { //×ボタンをクリックしたら
    modal.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
});