$(function() {
    // 変数に要素を入れる
    let open = $(' #js-open');
    let close = $('.modal-close');
    let container = $('.modal-container');

    //開くボタンをクリックしたらモーダルを表示する
    open.on('click', function() {
        container.addClass('active');
        return false;
    });

    //閉じるボタンをクリックしたらモーダルを閉じる
    close.on('click', function() {
        container.removeClass('active');
    });

    //モーダルの外側をクリックしたらモーダルを閉じる
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.modal-body').length) {
            container.removeClass('active');
        }
    });
});

$(function() {
    // 変数に要素を入れる
    let open = $(' #logout');
    let close = $('.modal-logout-close');
    let container = $('.modal-logout-container');

    //開くボタンをクリックしたらモーダルを表示する
    open.on('click', function() {
        container.addClass('active');
        return false;
    });

    //閉じるボタンをクリックしたらモーダルを閉じる
    close.on('click', function() {
        container.removeClass('active');
    });

    //モーダルの外側をクリックしたらモーダルを閉じる
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.modal-logout-body').length) {
            container.removeClass('active');
        }
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.msg').length) {
            container.removeClass('active');
        }
    });
});

$(function() {
    // 変数に要素を入れる
    let open = $('#delete');
    let close = $('.modal-delete-close');
    let container = $('.modal-delete-container');

    //開くボタンをクリックしたらモーダルを表示する
    open.on('click', function() {
        container.addClass('active');
        return false;
    });

    //閉じるボタンをクリックしたらモーダルを閉じる
    close.on('click', function() {
        container.removeClass('active');
    });

    //モーダルの外側をクリックしたらモーダルを閉じる
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.modal-delete-body').length) {
            container.removeClass('active');
        }
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.msg').length) {
            container.removeClass('active');
        }
    });
});