function createQR(id) {
    const url = 'https://localhost/task/php-CS/register_card.php?id=' + id;

    console.log(id);
    // const url = location.href;
    // const url = "https://www.javadrive.jp/javascript/webpage/index10.html";

    console.log(url)
    let qrtext = url;
    let utf8qrtext = unescape(encodeURIComponent(qrtext));
    $("#img-qr").html("");
    $("#img-qr").qrcode({text:utf8qrtext}); 
};
