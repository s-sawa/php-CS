//モーダルの表示と非表示
const modal = $("#js-modal");
const overlay = $("#js-overlay");
const close = $("#js-close");
// const close = $("#js-close");
const open = $("#js-open");


open.on('click', function() { //ボタンをクリックしたら
    $('#js-overlay, #js-modal').fadeIn(300);
    modal.addClass("open"); // modalクラスにopenクラス付与
    modal.addClass("w-max-[5vw]"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
});
close.on('click', function() { //×ボタンをクリックしたら
    $('#js-overlay, #js-modal').fadeOut(300);
    modal.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
});

function deleteMsg(id) {
    alert(id);
}

addEventListener('click', outsideClose);
function outsideClose(e) {
  if (e.target == overlay) {    
    $('#js-overlay, #js-modal').fadeOut(300);
    modal.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    
  }
  console.log(e.target)
}
